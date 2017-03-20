<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;

class AdminDashboard extends Controller
{
    //

    public function index(Request $request){
    	   
    	 //   $abc=array('user'=>Auth::user());
    	    echo $role = User::where('email', $request['email'])->with('Role')->first();
        
       
          // foreach($role as $userData){
          //  	echo  $userData = $userData;
          //   }
    	    //print_r($role);
    	   
    	   	return view('admin.dashboard.index',array('user'=>Auth::user()));	
		}

    public function charts(){
        // call  the charts
      return view('admin.dashboard.charts');
    }
  }
?>