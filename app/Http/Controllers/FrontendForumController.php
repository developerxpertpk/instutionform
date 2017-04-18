<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendForumController extends Controller
{
    public function forum_index(){
    	return view('forum.forum_index');
    }
}
