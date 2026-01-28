<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transmission;
use App\Models\CarInventory;
use Yajra\DataTables\DataTables;

class TransmissionController extends Controller
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
            $data = Transmission::latest()->orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="transmission/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-transmission btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.transmission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.transmission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required|unique:transmission',
        ]);

        $Transmission = new Transmission();
        $Transmission->name = $request->name;
        $result = $Transmission->save();
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
        //
        $Transmission = Transmission::where('id',$id)->get();
        return view('admin.transmission.edit',['transmission'=>$Transmission]);
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
        //
        $request->validate([
            'name'=>'required|unique:transmission,name,'.$id.',id',
        ]);

        $Transmission = Transmission::where('id',$id)->update([
            'name' => $request->name,
        ]);

        return $Transmission;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = CarInventory::where('transmission',$id)->get();
        $count = $check->count();
        if($count == 0){
            $Transmission = Transmission::where('id',$id)->delete();
            if($Transmission){
                return $Transmission;
            }
        }else{
            return "You Can't Delete This. This Type is used in Car Inventory List.";
        }
    }
}
