<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use File;
use Storage;

class CustomregisterController extends BaseController
{

	public function showloginform(){
		return view('auth.login');	
	}
   
   public function insert(Request $request){
		$rules=array(
            'fname' => 'required|max:255|regex:/^[a-zA-Z]*$/',
            'lname' => 'required|max:255|regex:/^[a-zA-Z]*$/',
            'email' => 'required|email|max:255|unique:users|regex:/^[a-zA-Z0-9@_.]*$/',
            'password' => 'required|min:6|confirmed|regex:/^[a-zA-Z0-9@_. ]*$/',
            'image' => 'image',
            'address' => 'required|regex:/^[a-zA-Z0-9# ,.]*$/',
			);

		$validator = Validator::make($request->all(), $rules);

		if($validator -> fails()){
			return redirect('register')->withErrors($validator);
		}

      $insert =new User();
      /*Entries for database*/
      $insert->fname = $request['fname'];
      $insert->lname = $request['lname'];
      $insert->email = $request['email'];
      $insert->password = bcrypt($request['password']);
      $insert->gender = $request['gender'];
      $insert->address = $request['address'];

      if($request->hasFile('image')){
         $file = $request->file('image');
         $extention = $file->getClientOriginalExtension();

         if($extention == 'jpg' || $extention == 'png' || $extention == 'jpeg' ){

            $result=DB::select("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".env('DB_DATABASE')."' AND TABLE_NAME = 'users'");

            $user_id=$result[0]->AUTO_INCREMENT;

         
            $fileName = $file->getClientOriginalName();
            
            
            $userfolder_path = 'upload/users/user'.'_'.$user_id.'/images/profile_pic/current_dp';
            $userfolder_path_1 = 'upload/users/user'.'_'.$user_id.'/images/profile_pic';
            
            $destinationPath = public_path().'/'.$userfolder_path;
            $destinationPath_1 = public_path().'/'.$userfolder_path_1;

            /*Check for folder existance*/
            if (!File::exists($destinationPath)){
              File::makeDirectory($destinationPath, 0777, true);
            }

            $file->move($destinationPath,$fileName);
            //  copy image in profile pic folder
            $copy = File::copy($destinationPath.'/'.$fileName,$destinationPath_1.'/'.$fileName);

            $insert->image = $fileName;

         }else{
            return redirect('register')
               ->withErrors(array('image_error' => 'Image type must be of jpg, png or jpeg'));
         }
      }

      $insert->save();
      return redirect()->route('show.login');	
	}
}
