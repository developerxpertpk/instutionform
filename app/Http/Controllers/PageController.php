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

    /*For FAQ page*/
    public function faq_function(){
        $faq_data=Freq_ask_question::orderBy('id','DESC')->get();
        $page = Page::orderBy('id','DESC')->where('active','=',0)->get();
        return view('user.guests.faq')->with('faq_data',$faq_data)
                                        ->with('page',$page);
    }


    // function for home page
    public function home()
    {
        $page = Page::orderBy('id', 'DESC')->where('active', '=', 0)->get();
        return view('forum&finder_welcome')->with('page', $page);

    }

    // function for show page

    public function page_show($slug){
        // echo $slug;
        // die('page_show');



        $particular_page = Page::where('slug','=',$slug)->get();
        if($particular_page->count() == ''){
            //do something here
            echo "<h1>Error: Route Not Found</h1>";
            die();
        }
        // echo "<pre>";
        // print_r($particular_page);
        // die();
        $page = Page::orderBy('id','DESC')->where('active','=',0)->get();
        return view('admin.dashboard.cms.page')->with('page',$page)
                                                ->with('particular_page',$particular_page);

    }

    // Index function is use by admin to show page detail
    public function index(Request $request)
    {
        $page = Page::orderBy('id', 'DESC')->paginate(5);
        return view('admin.dashboard.cms.content', compact('page'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    // store function is us to storepage in database
    public function store(Request $request)
    {
        //validation on input

        $rules = array(
            'content_type' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('addpages')
                ->withErrors($validator)
                ->withInput();
        } else {
            /* make model object*/
            $page = new Page();
            $page->content_type = $request['content_type'];
            $page->title = $request['title'];
            $page->slug = $request['slug'];
            $page->content = $request['content'];
            $page->save();

            return redirect()->route('content')
                ->with('success', 'page uploaded successfully');

        }


    }

    /* function to show FAQ's*/

    public function show_faq(Request $request)
    {

        $ques = Freq_ask_question::orderBy('id', 'DESC')->paginate(5);
        return view('admin.dashboard.cms.freq_ask_ques', compact('ques'))
            ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /* function used to store freq_Ask_question in database*/
    public function question_submit(Request $request)
    {

        $rules = array(
            'question' => 'required',
            'answer' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            return redirect()->route('add_question')
                ->withErrors($validator)
                ->withInput();
        } else {
            $ques = new Freq_ask_question();
            $ques->question = $request['question'];
            $ques->answer = $request['answer'];
            $ques->save();
            return redirect()->route('freq_ask_ques')
                ->with('success', 'Your Question is submitted successfully !!!');

        }
    }

    // function to destroy particuler question
    public function delete_faq($question)
    {

        Freq_ask_question::find($question)->delete();
        return redirect()->route('freq_ask_ques')
            ->with('success', 'Question deleted successfully !!! ');

    }

    public function destroy($id)
    {
        Page::find($id)->delete();
        return  redirect()->route('content')
                            ->with('success','deleted succesfully');

    }

    // function to edit faq_ask_quest

    public function edit_faq($id){
        $result = Freq_ask_question::find($id);
        return  view('admin.dashboard.cms.edit_faq',compact('result'));
    }

    // function to update faq

    public function update_faq(Request $request,$id){
        $result = Freq_ask_question::find($id)->update($request->all());
        return redirect()->route('freq_ask_ques')
                            ->with('success','Updated Successfully');

    }

}
