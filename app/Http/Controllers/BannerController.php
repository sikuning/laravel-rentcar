<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Banner;
use File;   

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Banner::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function($row){
                    $image = '<img src="'.asset('public/slides/'.$row->image).'" width="100px">';
                    return $image;
                })
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        return '<span class="badge badge-complete">Show</span>';
                    }else{
                        return '<span class="badge badge-pending">Hidden</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="banner-slider/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-slide btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action','image','status'])
                ->make(true);
        }

        return view('admin.banner-slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner-slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'img' => 'required|mimes:jpeg,jpg,png|max:5000',
        ]);

        if($request->img){
            $ext = $request->img->getClientOriginalExtension();
            $f_name = $request->img->getClientOriginalName();
            $image = str_replace(array(' ','_'),'-',strtolower($f_name));
            $request->img->move(public_path('slides'),$image);
        }else{
            $image = '';
        }
        $banner = new Banner;
        $banner->title = $request->input('title');
        $banner->desc = $request->input('desc');
        $banner->image = $image;
        $result = $banner->save();

        if($result){ 
            return $result;
        }else{
            return 'Something goes to wrong. Please try again later';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::where('id',$id)->first();
        return view('admin.banner-slider.edit',['banner'=>$banner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'img' => 'mimes:jpeg,jpg,png|max:5000',
        ]);


        if($request->input('old_img') != ''  && !$request->img){
            $image = $request->input('old_img');
        }else if($request->input('old_img') != '' && $request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('slides'),$image);
            $image_path = public_path('slides/').$request->input('old_img');  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }else if($request->input('old_img') == '' && $request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('slides'),$image);
        }else if($request->input('old_img') == '' && !$request->img){
           $image = '';
        }

       $banner = Banner::where(['id'=>$id])->update([
            "title"=>$request->input('title'),
            "desc"=>$request->input('desc'),
            "image"=>$image,
            "status"=>$request->input('status'),
       ]);
        return $banner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Banner::where('id',$id)->pluck('image');
        $image_path = public_path('slides/').$image[0];  // Value is not URL but directory file path
        // return $image_path;
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $destroy = Banner::where('id',$id)->delete();
        if($destroy){
            return $destroy;
        }
        
        
    }
}
