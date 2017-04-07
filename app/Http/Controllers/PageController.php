<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Page;
use App\Freq_ask_question;

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
       // Index function is use by admin to show page detail
    public function index(Request $request){
        $page = Page::orderBy('id','DESC')->paginate(5);
        return view('admin.dashboard.cms.content',compact('page'))
                ->with('i', ($request->input('page', 1) - 1) * 5);

    }
    // store function is us to storepage in database
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

    /* function to show FAQ's*/

    public function show_faq(Request $request){

        $ques = Freq_ask_question::orderBy('id','DESC')->paginate(5);
        return view('admin.dashboard.cms.freq_ask_ques',compact('ques'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }
    /* function used to store freq_Ask_question in database*/
    public function question_submit(Request $request)
    {

        $rules =array(
            'question' => 'required',
            'answer' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){

            return redirect()->route('add_question')
                             ->withErrors($validator)
                             ->withInput();
        }else {
            $ques = new Freq_ask_question();
            $ques->question = $request['question'];
            $ques->answer = $request['answer'];
            $ques->save();
            return redirect()->route('freq_ask_ques')
                             ->with('success','Your Question is submitted successfully !!!');

        }
    }
}