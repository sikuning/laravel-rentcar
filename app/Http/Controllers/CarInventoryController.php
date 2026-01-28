<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarInventory;
use App\Models\CarTypes;
use App\Models\Locations;
use App\Models\FuelTypes;
use App\Models\Transmission;
use App\Models\Extras;
use Yajra\DataTables\DataTables;
use File;

class CarInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CarInventory::select(['car_inventories.*','car_types.name as type_name','transmission.name as trans_name'])
                    ->leftJoin('car_types','car_inventories.car_type', '=','car_types.id')
                    ->leftJoin('transmission','transmission.id', '=','car_inventories.transmission')
                    ->orderBy('car_inventories.car_id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){
                    $image = '<img src="'.asset('public/carImages/'.$row->car_image).'" width="100px" />';
                    return $image;
                })
                
                ->addColumn('action', function($row){
                    $btn = '<a href="carInventory/'.$row->car_id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-carInvtry btn btn-danger btn-sm" data-id="'.$row->car_id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['image','action'])
                ->make(true);
        }

        return view('admin.car_inventory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transmission = Transmission::all();
        $fuelTypes = FuelTypes::all();
        $carTypes = CarTypes::all();
        $extras = Extras::all();
        return view('admin.car_inventory.create',['carTypes'=>$carTypes,'fuelTypes'=>$fuelTypes,'transmission'=> $transmission,'extras'=>$extras]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->input();
        $request->validate([
            'car_name' => 'required',
            'descr' => 'required',
            'price' => 'required',
            'car_type' => 'required',
            'fuel_type' => 'required',
            'mileage' => 'required',
            'model_year' => 'required',
            'transmission' => 'required',
            'passengers' => 'required',
            'doors' => 'required',
            'bags' => 'required',
            'img' => 'required|mimes:jpeg,jpg,png|max:1000',
        ]);

        if($request->img){
            $ext = $request->img->getClientOriginalExtension();
            $f_name = $request->img->getClientOriginalName();
            $image = str_replace(array(' ','_'),'-',strtolower($f_name));
            $request->img->move(public_path('carImages'),$image);
        }else{
            $image = '';
        }
        $CarInventory = new CarInventory;
        $CarInventory->car_name = $request->input('car_name');
        $CarInventory->car_slug = str_replace(array(' ','_'),'-',strtolower($request->input('car_name')));
        $CarInventory->car_descr = $request->input('descr');
        $CarInventory->price = $request->input('price');
        $CarInventory->car_type = $request->input('car_type');
        $CarInventory->fuel_type = $request->input('fuel_type');
        $CarInventory->mileage = $request->input('mileage');
        $CarInventory->model_year = $request->input('model_year');
        $CarInventory->transmission = $request->input('transmission');
        $CarInventory->passengers = $request->input('passengers');
        $CarInventory->doors = $request->input('doors');
        $CarInventory->bags = $request->input('bags');
        $CarInventory->car_image = $image;
        if($request->input('extras')){
            $CarInventory->extras = implode(',',$request->input('extras'));
        }
        $result = $CarInventory->save();

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
        $transmission = Transmission::all();
        $fuelTypes = FuelTypes::all();
        $carTypes = CarTypes::all();
        $extras = Extras::all();
        $data = CarInventory::where(['car_id'=>$id])->first();
        return view('admin.car_inventory.edit',['carInventory'=> $data,'carTypes'=>$carTypes,'fuelTypes'=>$fuelTypes,'transmission'=> $transmission,'extras'=>$extras]);
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
            'car_name' => 'required',
            'descr' => 'required',
            'price' => 'required',
            'car_type' => 'required',
            'fuel_type' => 'required',
            'mileage' => 'required',
            'model_year' => 'required',
            'transmission' => 'required',
            'passengers' => 'required',
            'doors' => 'required',
            'bags' => 'required',
            'img' => 'mimes:jpeg,jpg,png|max:1000',
        ]);


        if($request->input('old_img') != ''  && !$request->img){
            $image = $request->input('old_img');
        }else if($request->input('old_img') != '' && $request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('carImages'),$image);
            $image_path = public_path('carImages/').$request->input('old_img');  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }else if($request->input('old_img') == '' && $request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('carImages'),$image);
        }else if($request->input('old_img') == '' && !$request->img){
           $image = '';
        }

        $extras = '';
        if($request->input('extras')){
            $extras = implode(',',$request->input('extras'));
        }

       $CarInventory = CarInventory::where(['car_id'=>$id])->update([
            "car_name"=>$request->input('car_name'),
            "car_slug"=>str_replace(array(' ','_'),'-',strtolower($request->input('car_name'))),
            "car_descr"=>$request->input('car_descr'),
            "price"=>$request->input('price'),
            "car_type"=>$request->input('car_type'),
            "fuel_type"=>$request->input('fuel_type'),
            "mileage"=>$request->input('mileage'),
            "model_year"=>$request->input('model_year'),
            "transmission"=>$request->input('transmission'),
            "passengers"=>$request->input('passengers'),
            "doors"=>$request->input('doors'),
            "bags"=>$request->input('bags'),
            "status"=>$request->input('status'),
            "car_image"=>$image,
            "extras"=>$extras,
       ]);
        return $CarInventory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $CarInventory= CarInventory::where('car_id',$id)->delete();
       return  $CarInventory;
    }
}
