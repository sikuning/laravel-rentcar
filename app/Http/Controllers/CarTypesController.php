<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarTypes;
use App\Models\CarInventory;
use Yajra\DataTables\DataTables;

class CarTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    //     $data = CarTypes::select("car_types.*",\DB::raw("GROUP_CONCAT(extras.name) as exname"))->leftJoin("extras",\DB::raw("FIND_IN_SET(extras.id,car_types.extras)"),">",\DB::raw("'0'"))
    // ->orderBy('car_types.id','desc')->groupBy('extras.id')->get();
        //return $data;
        if ($request->ajax()) {
            $data = CarTypes::select("car_types.*")
                ->orderBy('car_types.id','desc')->groupBy('car_types.id')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="carTypes/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-carType btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.car_types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car_types.create');
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
            'name'=>'required|unique:car_types',
            'desc'=>'required',
        ]);

        $carTypes = new CarTypes();
        $carTypes->name = $request->name;
        $carTypes->description = $request->desc;
        $result =  $carTypes->save();
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
        $carTypes = CarTypes::where('id',$id)->get();
        return view('admin.car_types.edit',['carTypes'=>$carTypes]);
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
            'name'=>'required|unique:car_types,name,'.$id.',id',
            'desc'=>'required',
        ]);

        $carTypes = CarTypes::where('id',$id)->update([
            'name' => $request->name,
            'description' => $request->desc,
        ]);

        return $carTypes;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = CarInventory::where('car_type',$id)->get();
        $count = $check->count();
        if($count == 0){
            $destroy = CarTypes::where('id',$id)->delete();
            if($destroy){
                return $destroy;
            }
        }else{
            return "You Can't Delete This. This Type is used in Car Inventory List.";
        }
        
    }
}
