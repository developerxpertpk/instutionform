<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use View;

class BaseController extends Controller{
    public function __construct(){

        $page=Page::orderBy('id','DESC')->where('active','=',0)->get();

        // Sharing is caring
        View::share('page', $page);
  }
}
