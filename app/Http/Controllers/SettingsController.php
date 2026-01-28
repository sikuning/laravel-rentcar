<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Session;

class SettingsController extends Controller
{
    public function yb_social_links(Request $request){
        $data=  DB::table('social_settings')->get();
        if($request->post()){

            $facebook = $request->facebook;
            if($request->facebook_status && $request->facebook_status == 'on'){
                $facebook_status = '1';
            }else{
                $facebook_status = '0';
            }

            $twitter = $request->twitter;
            if($request->twitter_status && $request->twitter_status == 'on'){
                $twitter_status = '1';
            }else{
                $twitter_status = '0';
            }

            $youtube = $request->youtube;
            if($request->youtube_status && $request->youtube_status == 'on'){
                $youtube_status = '1';
            }else{
                $youtube_status = '0';
            }

            $linkedin = $request->linkedin;
            if($request->linkedin_status && $request->linkedin_status == 'on'){
                $linkedin_status = '1';
            }else{
                $linkedin_status = '0';
            }

            $instagram = $request->instagram;
            if($request->instagram_status && $request->instagram_status == 'on'){
                $instagram_status = '1';
            }else{
                $instagram_status = '0';
            }

            $pinterest = $request->pinterest;
            if($request->pinterest_status && $request->pinterest_status == 'on'){
                $pinterest_status = '1';
            }else{
                $pinterest_status = '0';
            }
            
            foreach($data as $row){
                if($row->name == 'facebook'){
                    $update = DB::table('social_settings')->where('name','facebook')->update([
                        'value' => $facebook,
                        'status' => $facebook_status,
                    ]);
                }elseif($row->name == 'twitter'){
                    $update = DB::table('social_settings')->where('name','twitter')->update([
                        'value' => $twitter,
                        'status' => $twitter_status,
                    ]);
                }elseif($row->name == 'youtube'){
                    $update = DB::table('social_settings')->where('name','youtube')->update([
                        'value' => $youtube,
                        'status' => $youtube_status,
                    ]);
                }elseif($row->name == 'linkedin'){
                    $update = DB::table('social_settings')->where('name','linkedin')->update([
                        'value' => $linkedin,
                        'status' => $linkedin_status,
                    ]);
                }elseif($row->name == 'instagram'){
                    $update = DB::table('social_settings')->where('name','instagram')->update([
                        'value' => $instagram,
                        'status' => $instagram_status,
                    ]);
                }elseif($row->name == 'pinterest'){
                    $update = DB::table('social_settings')->where('name','pinterest')->update([
                        'value' => $pinterest,
                        'status' => $pinterest_status,
                    ]);
                }
            }
            return $update;
        }
        return view('admin.settings.social-links',['data'=> $data]);
    }

    public function yb_general_settings(Request $request){
        $data=  DB::table('general_setting')->get();
        if($request->post()){
            // return $request;
            $request->validate([
                'site_name' => 'required',
                'site_title' => 'required',
                'cont_email' => 'required',
                'cont_phone' => 'required',
                'cont_address' => 'required',
                'cur_format' => 'required',
            ]);
            
            if($request->input('old_img') != ''  && !$request->img){
                $image = $request->input('old_img');
            }else if($request->input('old_img') != '' && $request->img){
                $image = rand().str_replace(array(' ','_'),'-',$request->img->getClientOriginalName());
                $request->img->move(public_path('siteImages'),$image);

                $image_path = public_path('siteImages/').$request->input('old_img');
                if(File::exists($image_path)){
                    File::delete($image_path);
                }
            }else if($request->input('old_img') == '' && $request->img){
                $image = rand().str_replace(array(' ','_'),'-',$request->img->getClientOriginalName());
                $request->img->move(public_path('siteImages'),$image);
            }else if($request->input('old_img') == '' && !$request->img){
                $image = '';
            }
    
            $GeneralSetting = DB::table('general_setting')->update([
                "site_name"=>$request->site_name,
                "site_logo"=>$image,
                "site_title"=>$request->site_title,
                "contact_email"=>$request->cont_email,
                "contact_phone"=>$request->cont_phone,
                "contact_address"=>$request->cont_address,
                "cur_format"=>$request->cur_format,
                "theme_color"=>$request->theme_color,
            ]);
            return $GeneralSetting;
        }else{
            
            return view('admin.settings.general',['data'=> $data]);
        }
    }

    public function yb_rental_settings(Request $request){
        $data=  DB::table('rental_settings')->get();
        if($request->input()){
            $request->validate([
                'deposit_pay' => 'required',
                'tax_pay' => 'required',
            ]);
    
            $RentalSettings = DB::table('rental_settings')->update([
                "deposit_payment"=>$request->input('deposit_pay'),
                "tax_payment"=>$request->input('tax_pay'),
            ]);
            return  $RentalSettings;
        }else{
            $cur_format = DB::table('general_setting')->pluck('cur_format');
            // return $cur_format;
            return view('admin.settings.rental',['data'=> $data,'cur_format'=>$cur_format]);
        }
    }

   
}
