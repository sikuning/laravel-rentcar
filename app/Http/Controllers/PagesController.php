<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Pages;
use File;   

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Pages::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function($row){
                    if($row->status == '1'){
                        return '<span class="badge badge-complete">Show</span>';
                    }else{
                        return '<span class="badge badge-pending">Hidden</span>';
                    }
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="pages/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-page btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('admin.pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
            'title' => 'required|unique:pages',
            'desc' => 'required',
        ]);



        
        $pages = new Pages;
        $pages->title = $request->input('title');
        $pages->slug = str_replace(array('_',' '),'-',strtolower($request->title));
        $pages->desc = htmlspecialchars($request->input('desc'));
        if($request->status){
            $pages->status = $request->status;
        }
        $result = $pages->save();

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
        $data['page_detail'] = Pages::where('slug',$id)->where('status','1')->first();
        return view('public.custom',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages = Pages::where('id',$id)->first();
        return view('admin.pages.edit',['pages'=>$pages]);
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
            'title' => 'required|unique:pages,title,'.$id.',id',
            'desc' => 'required',
        ]);

        if($request->slug){
            $slug = str_replace(array('_',' '),'-',strtolower($request->slug));
        }else{
            $slug = str_replace(array('_',' '),'-',strtolower($request->title));
        }

       $pages = Pages::where(['id'=>$id])->update([
            "title"=>$request->input('title'),
            "slug"=>$slug,
            "desc"=>htmlspecialchars($request->input('desc')),
            "status"=>$request->input('status'),
       ]);
        return $pages;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Pages::where('id',$id)->delete();
        if($destroy){
            return $destroy;
        }
        
        
    }
}
