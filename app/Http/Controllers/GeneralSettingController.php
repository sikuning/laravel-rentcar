<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\GeneralSetting;
use File;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=  GeneralSetting::where(['id'=>'1'])->get();
        //$city = DB::table("cities")->get();
       // $countries = DB::table("countries")->get();
        return view('admin.general_setting.index',['data'=> $data]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('admin.general_setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
      /*  $request->validate([
            'site_title' => 'required',
            'img' => 'required',
            'cont_email' => 'required',
            'cont_phone' => 'required',
            'cont_address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'status' => 'required',
        ]);

        if($request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('siteImages'),$image);
        }else{
            $image = '';
        }

        $GeneralSetting = new GeneralSetting;
        $GeneralSetting->site_title=$request->input('site_title');
        $GeneralSetting->site_logo=$image;
        $GeneralSetting->contact_email=$request->input('cont_email');
        $GeneralSetting->contact_phone=$request->input('cont_phone');
        $GeneralSetting->contact_address=$request->input('cont_address');
        $GeneralSetting->city=$request->input('city');
        $GeneralSetting->country=$request->input('country');
        $GeneralSetting->status=$request->input('status');
        $result = $GeneralSetting->save();
        return $result;*/
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

       // return $request->input();
        $request->validate([
            'site_title' => 'required',
            'cont_email' => 'required',
            'cont_phone' => 'required',
            'cont_address' => 'required',
        ]);

        if($request->input('old_img') != ''  && !$request->img){
            $image = $request->input('old_img');
        }else if($request->input('old_img') != '' && $request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('siteImages'),$image);
             // Value is not URL but directory file path
            $image_path = public_path('siteImages/').$request->input('old_img');
            if(File::exists($image_path)){
                File::delete($image_path);
            }
        }else if($request->input('old_img') == '' && $request->img){
            $image = rand().$request->img->getClientOriginalName();
            $request->img->move(public_path('siteImages'),$image);
        }else if($request->input('old_img') == '' && !$request->img){
            $image = '';
        }

      $GeneralSetting = GeneralSetting::where(['id'=>$id])->update([
            "site_title"=>$request->input('site_title'),
            "site_logo"=>$image,
            "contact_email"=>$request->input('cont_email'),
            "contact_phone"=>$request->input('cont_phone'),
            "contact_address"=>$request->input('cont_address'),
        ]);
        return $GeneralSetting;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
