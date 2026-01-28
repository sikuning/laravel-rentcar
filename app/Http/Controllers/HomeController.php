<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Locations;
use App\Models\CarInventory;
use App\Models\CarTypes;
use App\Models\RentalSettings;
use App\Models\PayMethod;
use App\Models\booking;
use App\Models\Banner;
use DB;

class HomeController extends Controller
{
    function index(){
    	//
    $locations = Locations::all();
    $banner = Banner::latest()->where('status','1')->get();
    $car_list = CarInventory::select(['car_inventories.*','car_types.name as type_name','fuel_types.name as fuel_name','transmission.name as trans_name',
    \DB::raw('GROUP_CONCAT(DISTINCT extras.name ORDER BY extras.id) as extra_name')])
                                ->join('car_types','car_inventories.car_type','=','car_types.id')
                                ->join('fuel_types','fuel_types.id','=','car_inventories.fuel_type')
                                ->join('transmission','transmission.id','=','car_inventories.transmission')
                                ->leftJoin('extras',\DB::raw("FIND_IN_SET(extras.id,car_inventories.extras)"),">",\DB::raw("'0'"))
                                ->groupBy('car_inventories.car_id')
                                ->orderBy('car_inventories.car_id','desc')
                                ->limit('6')
                                ->get();
	return view('public.index',['banner'=>$banner,'locations'=>$locations,'car_list'=>$car_list]);
    }


    public function searchCars(Request $request){
        Paginator::useBootstrap();
        
        $p_date = date('Y/m/d h:i');
        $r_date = date('Y/m/d h:i',strtotime('+1day'));
        // return $r_date;
        if($request->input()){
            $p_date = $request->pick_date;
            $r_date = $request->return_date;
        }
        $pick = explode(' ',$p_date);
        $pick_date = $pick[0];
        // return $pick_date;
        $return = explode(' ',$r_date);
        $return_date = $return[0];
        // return $pick_date;
        $booked = booking::where('pick_date','<=',$pick_date)
                        ->where('return_date','>=',$return_date)
                        ->pluck('car_id')->toArray();
        // return $booked;

        $car_list = CarInventory::select(['car_inventories.*','car_types.name as type_name','fuel_types.name as fuel_name','transmission.name as trans_name',
        \DB::raw('GROUP_CONCAT(DISTINCT extras.name ORDER BY extras.id) as extra_name')])
                                ->join('car_types','car_inventories.car_type','=','car_types.id')
                                ->join('fuel_types','car_inventories.fuel_type','=','fuel_types.id')
                                ->join('transmission','car_inventories.transmission','=','transmission.id')
                                ->leftJoin('extras',\DB::raw("FIND_IN_SET(extras.id,car_inventories.extras)"),">",\DB::raw("'0'"))
                                ->groupBy('car_inventories.car_id')
                                ->paginate('10');
        $locations = Locations::all();
        if($request->input()){
            return view('public.car_listing',['car_list'=>$car_list,'locations'=>$locations,'booked'=>$booked]);
        }else{
            return view('public.listing',['car_list'=>$car_list,'locations'=>$locations,'booked'=>$booked]);
        }
        


    }

    public function rentalDetails(Request $request){
        $car_detail = CarInventory::select(['car_inventories.*','car_types.name as type_name','transmission.name as trans_name','fuel_types.name as fuel_name',
        \DB::raw('GROUP_CONCAT(DISTINCT extras.name ORDER BY extras.id) as extra_name')])
                                ->where('car_inventories.car_slug',$request->input('car'))
                                ->join('car_types','car_inventories.car_type','=','car_types.id')
                                ->join('transmission','car_inventories.transmission','=','transmission.id')
                                ->join('fuel_types','car_inventories.fuel_type','=','fuel_types.id')
                                ->leftJoin('extras',\DB::raw("FIND_IN_SET(extras.id,car_inventories.extras)"),">",\DB::raw("'0'"))
                                ->groupBy('car_inventories.car_id')
                                ->first();
        $rent_setting = DB::table('rental_settings')->get();
        return view('public.rental_details',['car'=>$car_detail,'rent_details'=>$rent_setting]);
    }

}
