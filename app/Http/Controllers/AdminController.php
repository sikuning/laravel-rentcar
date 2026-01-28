<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\CarInventory;
use App\Models\User;
use App\Models\booking;
use Session;

class AdminController extends Controller{

	function index(){

		return view('admin.index');
	}

	public function login_submit(Request $request){
		$request->validate([
			'username'=>'required',
			'password'=>'required',
		]); 
		$login = Admin::where(['username'=>$request->username])->pluck('password')->first();
		
		if(empty($login)){
				Session::flash('error','Username does not exists');
				return redirect()->back();
			}else{
				if(Hash::check($request->password,$login)){
					$admin = Admin::first();
					$request->session()->put('admin','1');
					return redirect('/admin/dashboard');
				}else{
					Session::flash('error','Username and Password does not matched');
				return redirect()->back();
				}
			}
	    
	}

	function dashboard(){
		$data['inventory'] = CarInventory::count();
		$data['users'] = User::count();
		$data['bookings'] = booking::count();
		$data['booking'] = booking::select(['bookings.*','car_inventories.car_name','users.name as user_name','locations.name as location_name'])
                    ->leftJoin('car_inventories','bookings.car_id','=','car_inventories.car_id')
                    ->leftJoin('users','users.id','=','bookings.user_id')
                    ->leftJoin('locations','locations.id','=','bookings.pic_loc')
                    ->orderBy('bookings.id','desc')->limit('5')->get();
        return view('admin.dashboard',$data);
	}

}


 ?>