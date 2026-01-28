<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locations;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Locations::latest()->orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="locations/'.$row->id.'/edit" class="btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete-locations btn btn-danger btn-sm" data-id="'.$row->id.'">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.locations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.locations.create');
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
            'email'=>'required',
            'phone'=>'required|numeric',
            'address'=>'required',
            'zipcode'=>'required|numeric',
            'state'=>'required',
            'city'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'thumb' => 'mimes:jpeg,jpg,png|max:1000'
        ]);

        if(!$request->thumb){
            $image = '';
        }else{
            $ext = $request->thumb->getClientOriginalExtension();
            $image = rand().'.'.$ext;
            $request->thumb->move(public_path('location_thums'),$image);
        }

        $locations = new Locations();
        $locations->name = $request->name;
        $locations->email = $request->email;
        $locations->phone = $request->phone;
        $locations->address = $request->address;
        $locations->zipcode = $request->zipcode;
        $locations->country = $request->country;
        $locations->state = $request->state;
        $locations->city = $request->city;
        $locations->latitude = $request->latitude;
        $locations->longitude = $request->longitude;
        $locations->thumb = $image;
        $result =  $locations->save();
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
        $locations = Locations::where('id',$id)->get();

        return view('admin.locations.edit',['locations'=>$locations]);
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
            'email'=>'required',
            'phone'=>'required|numeric',
            'address'=>'required',
            'zipcode'=>'required|numeric',
            'state'=>'required',
            'city'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'thumb' => 'mimes:jpeg,jpg,png|max:1000'
        ]);

        if(!$request->thumb){
            $image = '';
        }else{
            $ext = $request->thumb->getClientOriginalExtension();
            $image = rand().'.'.$ext;
            $request->thumb->move(public_path('location_thums'),$image);
        }

        $locations = Locations::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'thumb' => $image,
        ]);
        
        return $locations;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locations = Locations::where('id',$id)->delete();
        if($locations){
            return $locations;
        }
    }
}
