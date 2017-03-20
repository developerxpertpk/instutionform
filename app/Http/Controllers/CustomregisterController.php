<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class CustomregisterController extends Controller
{

	public function showloginform(){
		return view('auth.login');	
		}
 	
 	protected function validator(array $data)
    	{
        return Validator::make($data, [
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            
        	]);
    	}

   public function insert(Request $request){

		$insert =new User();
		// check weather request has image path or not 
		echo "<pre>"; 
		print_r($insert);

		if($file = $request->hasFile('image')) { 
			
	                   $file = $request->file('image');
	                   $fileName = $file->getClientOriginalName() ;
	                   $extention = $file->getClientOriginalExtension();
	                   $destinationPath = public_path().'/upload/' ;
	                   $file->move($destinationPath,$fileName);
	                 
	             }
	            
	              $insert->fname = $request['fname'];
	              $insert->lname = $request['lname'];
	              $insert->email = $request['email'];
	              $insert->password = bcrypt($request['password']);
	              $insert->gender = $request['gender'];
	              $insert->image = $fileName;
	              $insert->address = $request['address'];
	
	            
			return redirect()->route('show.login');
	    }

		// public function showDashboard(){
		// 	return view('admin.dashboard.index');	
		// }

}
