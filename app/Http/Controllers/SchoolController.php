<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    //
    public function index(){
    	return view('admin.dashboard.school.index');
    }

    public function store(Request $request){
 
    	die('a');
    }
}
