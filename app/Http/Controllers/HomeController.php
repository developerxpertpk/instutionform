<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

 public function index()
    {
        // if(Auth::check()){
        //     echo "yes";
        //     die('a');
        // }else{
        //     echo "no";
        //      die('b');
        // }
        // die('a');
        
        if(Auth::user()->role->role == 'admin'){
            return view('admin.dashboard.index');
        }else{
            return view('home');
        }
    }    
}
