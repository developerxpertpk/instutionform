<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;


class DashboardController extends Controller
{
    //
    public function index(Request $request){  
     
    	  	return view('admin.dashboard.index');	
		}

	public function chart(Request $request){  
     
    	  	return view('admin.dashboard.charts');	
		}



	public function pwdchange(Request $request){

		 $rules = array(
            'current-password' => 'required',
            'password' => 'required|alphaNum|between:6,16|confirmed',
            'password_confirmation' => 'required'
        );
		 	// VALIDATING THE INPUT
        $validator = Validator::make($request->all(), $rules);


       if($validator->fails()){

       		return redirect()->route('admin.changepwd')->withErrors($validator);
        	
        }else{

				if(Auth::check()){
					$request_data = $request->All();
				    $old_pwd=$request_data['current-password'];
					$new_pwd=$request_data['password'];
					$confirm_pwd=$request_data['password_confirmation'];
					$current_password = Auth::User()->password; 

				  if(Hash::check($old_pwd, $current_password)) {

				  		$user_id =Auth::User()->id;
				  		$obj_user= User::find($user_id);

				  		if($new_pwd==$confirm_pwd){

				  			$new_pwd=Hash::make($request_data['password']);
				  			$obj_user->password = $new_pwd;
				  			$obj_user->save();	

				  			return redirect()->route('admin.changepwd')
				  				->with('success', 'Password changed successfully');

					  		}else{

					  			return redirect()->route('admin.changepwd')
					  			->withErrors('Your New Password and confirm password are not match');
					  		}
				  		
		            }else{
		            	return redirect()->route('admin.changepwd')
		            	->withErrors('Your old password does not match');
		            }
        	 }	

		}
	} // END OF FUNCTION



}
