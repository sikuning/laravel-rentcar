<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialNetworks;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=  SocialNetworks::get();
        return view('admin.social_network.index',['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       // return view('admin.social_network.create');
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
      /*  $request->validate([
            'facebook' => 'required',
            'twitter' => 'required',
            'linked_in' => 'required',
            'instagram' => 'required',
        ]);

        $SocialNetworks = new SocialNetworks;
        $SocialNetworks->facebook=$request->input('facebook');
        $SocialNetworks->twitter=$request->input('twitter');
        $SocialNetworks->linked_in=$request->input('linked_in');
        $SocialNetworks->instagram=$request->input('instagram');
        $result = $SocialNetworks->save();
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
        //return $id;

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
        //return $request->input();
        $request->validate([
            'facebook' => 'required',
            'twitter' => 'required',
            'linked_in' => 'required',
            'instagram' => 'required',
        ]);

        $SocialNetworks = SocialNetworks::where(['social_id'=>$id])->update([
            "facebook"=>$request->input('facebook'),
            "twitter"=>$request->input('twitter'),
            "linked_in"=>$request->input('linked_in'),
            "instagram"=>$request->input('instagram'),
        ]);
        return $SocialNetworks;
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
