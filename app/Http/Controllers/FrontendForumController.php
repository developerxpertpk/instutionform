<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;

class FrontendForumController extends Controller
{
    public function forum_index(){
    	return view('forum.forum_index');
    }

    public function create($id){
    	if(!empty($id)){
    		$school_data=School::find($id)->first();
    		return view('forum.forum_create')->with('schooldata',$school_data);
    	}
    	return view('forum.forum_create');
    	/*echo "<pre>";
    	print_r($school_data);*/

    }
}
