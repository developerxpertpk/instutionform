<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use File;
use Storage;

class CustomregisterController extends Controller
{

	public function showloginform(){
		return view('auth.login');	
	}
   
   public function insert(Request $request){

		$rules=array(
				'fname' => 'required|max:255|regex:/^[\pL\s]+$/u',
            'lname' => 'required|max:255|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:users|regex:/^[a-zA-Z0-9@_.]*$/',
            'password' => 'required|min:6|confirmed|regex:/^[a-zA-Z0-9@_. ]*$/',
            'image' => 'image',
            'address' => 'required',
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
         
            $fileName = $file->getClientOriginalName();
            $user_id = User::orderBy('id','DESC')->first()->id;

            $userfolder_path = 'upload/users/user'.'_'.$user_id.'/images/profile_pic/current_dp';
            $userfolder_path_1 = 'upload/users/user'.'_'.$user_id.'/images/profile_pic';
            
            $destinationPath = public_path().'/'.$userfolder_path;
            $destinationPath_1 = public_path().'/'.$userfolder_path_1;

            /*Check for folder existance*/
            if (!File::exists($destinationPath)){
              File::makeDirectory($destinationPath, 0777, true);
            }

            $files->move($destinationPath,$fileName);
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
