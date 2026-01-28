<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuelTypes;
use App\Models\CarInventory;
use Yajra\DataTables\DataTables;

class FuelTypeController extends Controller
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
            $data = FuelTypes::latest()->orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="fuelTypes/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-fuelTypes btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.fuel_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.fuel_type.create');
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
            'name'=>'required|unique:fuel_types',
        ]);

        $FuelTypes = new FuelTypes();
        $FuelTypes->name = $request->name;
        $result = $FuelTypes->save();
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
        $FuelTypes = FuelTypes::where('id',$id)->get();
        return view('admin.fuel_type.edit',['FuelTypes'=>$FuelTypes]);
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
            'name'=>'required|unique:fuel_types,name,'.$id.',id',
        ]);

        $FuelTypes =  FuelTypes::where('id',$id)->update([
            'name' => $request->name,
        ]);

        return  $FuelTypes;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = CarInventory::where('fuel_type',$id)->get();
        $count = $check->count();
        if($count == 0){
            $FuelTypes = FuelTypes::where('id',$id)->delete();
            if($FuelTypes){
                return $FuelTypes;
            }
        }else{
            return "You Can't Delete This. This Type is used in Car Inventory List.";
        }
    }
}
