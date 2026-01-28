<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\booking;
use App\Models\PayMethod;
use App\Models\User;
use App\Models\CarInventory;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Crypt;

use Razorpay\Api\Api;
use Session;
use Redirect;

class BookingController extends Controller
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
            $data = booking::select(['bookings.*','car_inventories.car_name','users.name as user_name','locations.name as location_name'])
                    ->leftJoin('car_inventories','car_inventories.car_id','=','bookings.car_id')
                    ->leftJoin('users','users.id','=','bookings.user_id')
                    ->leftJoin('locations','locations.id','=','bookings.pic_loc')
                    ->orderBy('bookings.id','desc')->get();

                 return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('pick_date',function($row){
                    return $row['pick_date'] = date('d M, Y',strtotime($row['pick_date']));
                })
                ->editColumn('return_date',function($row){
                    return $row['return_date'] = date('d M, Y',strtotime($row['return_date']));
                })
                ->editColumn('created_at',function($row){
                    return $row['created_at'] = date('d M, Y',strtotime($row['created_at']));
                })
                ->rawColumns(['pick_date'])
                ->make(true);
        }
        return view('admin.booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $PayMethod = PayMethod::all();
        $CarInventory = CarInventory::all();
        return view('admin.booking.create',['CarInventory'=> $CarInventory,'PayMethod'=> $PayMethod ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
        // return $input;
        $api = new Api('rzp_test_ThbsT8W3BYk7Nb', 'IilWHWipbFzmQ3KkpCvFnRSR');
        $payment = $api->payment->fetch($input['payment_id']);
        if(count($input)  && !empty($input['payment_id'])) {
            try {
                $response = $api->payment->fetch($input['payment_id'])->capture(array('amount'=>$payment['amount'])); 
            } catch (\Exception $e) {
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }

        $pick_up = explode('|',$request->input('pick_up'));
        $pick_date_time = explode(' ',$pick_up[0]);
        $drop = explode('|',$request->input('drop_of'));
        $return_date_time = explode(' ',$drop[0]);

        $user_id = session()->get('uid');
        
        $car_id = CarInventory::where('car_slug',$request->input('car_id'))->pluck('car_id');
        
        $booking = new booking();
        $booking->pick_date = $pick_date_time[0];
        $booking->pick_time = $pick_date_time[1];
        $booking->pic_loc = $pick_up[1];
        $booking->return_date = $return_date_time[0];
        $booking->return_time = $return_date_time[1];
        $booking->return_loc = $drop[1];
        $booking->car_id = $car_id[0];
        $booking->user_id = $user_id;
        $booking->pay_method = 'razorpay';
        $booking->pay_id = $request->input('payment_id');
        $booking->total_amount = $request->input('total_amount');
        $booking->advance_amount = $request->input('amount');
        $booking->pay_status = 'success';
        $result1 = $booking->save();
        $b_id = $booking->id;
        if($result1){
        return redirect('/booking/success');
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
        //

        $PayMethod = PayMethod::all();
        $CarInventory = CarInventory::all();
        $booking = booking::where('id',$id)->get();
        return view('admin.booking.edit',['booking'=>$booking,'CarInventory'=> $CarInventory,'PayMethod'=>$PayMethod]);
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
            'pick_date' => 'required',
            'pick_time' => 'required',
            'return_date' => 'required',
            'return_time' => 'required',
            'pic_loc' => 'required',
            'return_loc' => 'required',
            'admin'=> 'required',
            'pay_method' => 'required',
            'status' => 'required',
        ]);

         $booking = booking::where(['id'=>$id])->update([
            "pick_date"=>$request->input('pick_date'),
            "pick_time"=>$request->input('pick_time'),
            "return_date"=>$request->input('return_date'),
            "return_time"=>$request->input('return_time'),
            "pic_loc"=>$request->input('pic_loc'),
            "return_loc"=>$request->input('return_loc'),
            "user_id"=>$request->input('admin'),
            "pay_method"=>$request->input('pay_method'),
            "car_id"=>$request->input('car'),
            "status"=>$request->input('status'),
        ]);
        return $booking;
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
        $booking = booking::where('id',$id)->delete();
        if($booking){
            return $booking;
        }
    }
}
