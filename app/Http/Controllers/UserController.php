<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\booking;
use Crypt;
use Session;

class UserController extends Controller{

	function index(Request $request){
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at',function($row){
                    return $row['created_at'] = date('d M, Y',strtotime($row['created_at']));
                })
                ->addColumn('action', function($row){
                    if($row->status == '1'){
                        $btn = '<button class="btn btn-warning btn-sm userBlock" data-status="'.$row->status.'" data-id="'.$row->id.'">Block</button>';
                    }else{
                        $btn = '<button class="btn btn-success btn-sm userBlock" data-status="'.$row->status.'" data-id="'.$row->id.'">Unblock</button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

		return view('admin.users');
	}

	function yb_userLogin(Request $req){
		//echo $req->post('password')
        if(session()->has('uid')){
            return redirect('/user/my-profile');
        }else{
            $previousUrl =  '';
            if(url()->previous() != url('/login') && url()->previous() != url('/')){
                // echo '1';
                Session::put('prev_url',url()->previous());
                $previousUrl = url()->previous();
            //    return $previousUrl;
            }else{
                $previousUrl =  url('/');
            }
            
            if($req->input()){

                $req->validate([
                    'useremail'=>'required',
                    'password'=>'required',
                ]);

                $email = $req->useremail;
                $pass = password_hash($req->password,PASSWORD_DEFAULT);
                // return $pass
                $users = User::select('id','name','password','status')->where(['email'=>$email])->first();
                // return $users;   
                if($users && $users->status == '0'){
                    Session::flash('error', 'This Email / Userame is Blocked.');
                    return redirect()->back();
                }
                if($users && $users->password != ''){
                    if(Hash::check($req->password,$users->password)){
                        $req->session()->put('ulogin','1');
                        $req->session()->put('uid',$users->id);
                        $req->session()->put('uname',$users->name);
                    //  return $previousUrl;
                    if(session()->has('prev_url')){
                        return redirect(session()->get('prev_url'));  
                    }else{
                        return redirect($previousUrl);
                    }
                        
                        // return redirect()->back();
                    }else{
                        Session::flash('error', 'Wrong Password');
                        return redirect()->back();
                    }
                }else{
                    Session::flash('error', 'This Email / Userame Does not Exists.');
                    return redirect()->back();
                }

            }else{
                return view('public.login');
            }
        }
	}

    public function yb_userLogout(){
        if(session()->has('uid')){
            Session::flush();
            Auth::logout();
            return redirect()->back();
        }else{

        }
    }


	function yb_registerUser(Request $req){
        
        if(session()->has('uid')){
            return redirect('/user/my-profile');
        }else{
            if($req->input()){
                $validation = $req->validate([
                    'name'=>'required',
                    'email'=>'required|unique:users',
                    'phone'=>'required',
                    'password'=>'required'
                ]);
                
                    $users = new User();
                    $users->name = $req->name;
                    $users->email = $req->email;
                    $users->phone = $req->phone;
                    $users->password = Hash::make($req->password);
                    $result =  $users->save();
                    if($result == '1'){
                        Session::flash('register_success','Thanks for Joining Us');
                        return redirect('/u/register/success');
                    }
                
    
               
            }else{
                return view('public.register');
            }
        }
	}

    public function registerSuccess(){
        if(Session::has('register_success')){
            return view('public.register-success');
        }else{
            return redirect('/');
        }
    }


    public function yb_changeStatus(Request $request){
        if($request->post()){
            $id = $request->post('uId');
            $status = $request->post('status');

            $user = User::where('id',$id)->update([
                'status' => $status,
            ]);
            return $user;
        }
    }


    public function yb_userProfile(){
        if(session()->has('uid')){
            $id = session()->get('uid');
            $data['user_detail'] = User::select('name','email','phone','address','city')->where('id',$id)->first();
            $data['my_bookings'] = booking::select(['bookings.*','car_inventories.*'])->where('user_id',$id)
            ->join('car_inventories','car_inventories.car_id','=','bookings.car_id')                            
            ->get();
            return view('public.user.profile',$data);
        }else{
            return redirect('/login');
        }
    }


    

    public function yb_changePass(Request $request){
        if($request->input()){
            $id = session()->get('uid');
            $old = $request->input('old');
            $new = $request->input('new');
            $check = User::where('id',$id)->pluck('password');
            // echo  $old;
            // return $check[0];
            // return var_dump(Hash::check($old,$check[0]));
            if(Hash::check($old,$check[0])){
                $update = User::where('id',$id)->update([
                    'password' => Hash::make($new),
                ]);
                // return $update;
                Session::flash('error', '<div class="alert alert-success">Password changed successfully.</div>');
                return redirect()->back();
            }else{
                Session::flash('error', '<div class="alert alert-danger">Please Enter Correct Old Password.</div>');
                return redirect()->back();
            }
        }else{
            return view('public.change-pass');
        }
    }

}


 ?>