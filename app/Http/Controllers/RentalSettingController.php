<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalSettings;

class RentalSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=  RentalSettings::where(['rental_id'=>'1'])->get();
        return view('admin.rental_setting.index',['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       //return view('admin.rental_setting.create');
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
           'deposit_pay' => 'required',
           'tax_pay' => 'required',
           'security_pay' => 'required',
           'insurance_pay' => 'required',
       ]);

       $RentalSettings = new RentalSettings;
       $RentalSettings->deposit_payment=$request->input('deposit_pay');
       $RentalSettings->tax_payment=$request->input('tax_pay');
       $RentalSettings->security_payment=$request->input('security_pay');
       $RentalSettings->insurance_payment=$request->input('insurance_pay');
       $result = $RentalSettings->save();
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
        $request->validate([
            'deposit_pay' => 'required',
            'tax_pay' => 'required',
            'security_pay' => 'required',
            'insurance_pay' => 'required',
        ]);

        $RentalSettings = RentalSettings::where(['rental_id'=>$id])->update([
            "deposit_payment"=>$request->input('deposit_pay'),
            "tax_payment"=>$request->input('tax_pay'),
            "security_payment"=>$request->input('security_pay'),
            "insurance_payment"=>$request->input('insurance_pay'),
        ]);
        return  $RentalSettings;
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
