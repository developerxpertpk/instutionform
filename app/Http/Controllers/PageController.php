<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Page;

class PageController extends Controller
{

    // function for home page
    public function home(){
        $page = Page::orderBy('id','DESC')->paginate(5);
        return view('forum&finder_welcome',compact('page'));

    }

    // function for show page
    public function page_show($slug){
        $page = DB::table('pages')->where('slug','=',$slug)->get();
         return view('admin.dashboard.cms.page',compact('page'));

    }

    public function index(Request $request){
        $page = Page::orderBy('id','DESC')->paginate(5);
        return view('admin.dashboard.cms.content',compact('page'))
                ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    public function store(Request $request){
        //validation on input

        $rules = array(
            'content_type' =>'required',
            'title'=>'required',
            'slug'=>'required',
            'content' =>'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()) {
            return redirect()->route('addpages')
                ->withErrors($validator)
                ->withInput();
        }else{
            /* make model object*/
            $page=new Page();
            $page->content_type = $request['content_type'];
            $page->title = $request['title'];
            $page->slug =  $request['slug'];
            $page->content = $request['content'];
            $page->save();

            return redirect()->route('content')
                            ->with('success','page uploaded successfully');

        }


    }
}