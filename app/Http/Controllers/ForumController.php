<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function forum_index(){
    	return view('forum.forum_index');
    }
}
