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
 	
 /*	protected function validator(array $data)
    	{
        return Validator::make($data, [
            
        	]);
    	}*/

   	public function insert(Request $request){

   		$rules=array(
   				'fname' => 'required|max:255|regex:/^[\pL\s]+$/u',
          'lname' => 'required|max:255|regex:/^[\pL\s]+$/u',
          'email' => 'required|email|max:255|unique:users|regex:/^[a-zA-Z0-9@_.]*$/',
          'password' => 'required|min:6|confirmed|regex:/^[a-zA-Z0-9@_.]*$/',
          'image' => 'required|image',
          'address' => 'required',
   			);

   		$validator = Validator::make($request->all(), $rules);

   		if($validator -> fails()){
   			return redirect('register')->withErrors($validator);
   		}

		$insert =new User();
		// check weather request has image path or not 
		$file = $request->file('image');

		$extention = $file->getClientOriginalExtension();

		if($extention == 'jpg' || $extention == 'png' || $extention == 'jpeg' ){
			
			$fileName = $file->getClientOriginalName();
                   
            $image_name=str_ireplace(" ","_",$fileName);

            $imagefolder=$request['fname']."_".$request['lname']."_".rand().rand().rand();

            $path='upload/'.$imagefolder;

            $photo_path=$imagefolder."/".$image_name;

            $destinationPath = public_path($path);

            /*Check for folder existance*/
            if ( !File::exists($destinationPath) ){
                //Folder doesn't exists
                //creating new folder 
                File::MakeDirectory( $destinationPath );
            }
            

           	/*File upload on server*/
            $file->move($destinationPath,$image_name);

            /*Entries for database*/
            $insert->fname = $request['fname'];
            $insert->lname = $request['lname'];
            $insert->email = $request['email'];
            $insert->password = bcrypt($request['password']);
            $insert->gender = $request['gender'];
            $insert->image = $photo_path;
            $insert->address = $request['address'];

            $insert->save();

            
		return redirect()->route('show.login');

		}else{

			return redirect('register')
				->withErrors(array('image_error' => 'Image type must be of jpg, png or jpeg'));
		}
	}

}
