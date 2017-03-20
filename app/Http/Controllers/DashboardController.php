<?php

namespace App\Http\Controllers;
use Auth;
use App\User;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(Request $request){  
     
    	  	return view('admin.dashboard.index');	
		}

	public function chart(Request $request){  
     
    	  	return view('admin.dashboard.charts');	
		}

}
