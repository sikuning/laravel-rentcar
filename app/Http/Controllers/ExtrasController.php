<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Extras;
use Yajra\DataTables\DataTables;
use DB;

class ExtrasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = Extras::orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="extras/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-extras btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.extras.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cur_format = DB::table('general_setting')->pluck('cur_format');
        return view('admin.extras.create',['cur_format'=>$cur_format]);
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
            'name'=>'required',
            'price'=>'required|numeric',
        ]);

        $extras = new Extras();
        $extras->name = $request->name;
        $extras->price = $request->price;
        $result =  $extras->save();
        return $result;
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
        $extras = Extras::where('id',$id)->get();
        $cur_format = DB::table('general_setting')->pluck('cur_format');
        return view('admin.extras.edit',['extras'=>$extras,'cur_format'=>$cur_format]);
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
            'name'=>'required',
            'price'=>'required|numeric',
        ]);

        $extras = Extras::where('id',$id)->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        
        return $extras;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $extras = Extras::where('id',$id)->delete();
        if($extras){
            return $extras;
        }
    }


}
