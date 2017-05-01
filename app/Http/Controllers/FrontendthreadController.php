<?php

namespace App\Http\Controllers;

use Auth;
use App\Thread;
use App\Thread_comment;
use Illuminate\Http\Request;

class FrontendthreadController extends BaseController
{
    public function show_thread($id){
    	$thread=Thread::where('id','=',$id)->first();
    	return view('forum.view_thread')->with('thread',$thread);
    }

    public function create_thread(Request $request){
    	// print_r($request->all());
        // die('abc');

    	if( count( $request->all() ) ){
            $title = $request->title;
            $description = $request->description;
            $forum_id= $request->id;

            // print_r($request->all());
            // die();
        }else{
            // die('b');
            $title = $_GET['title'];
            $description =  $_GET['description'];
            $forum_id= $_GET['id'];
        }

    	

        /*if(strlen(trim($request->title) ) == 0 || strlen(trim($request->description) ) == 0) {
        	return view('forum.thread_create');
        }*/
        $rules=array(
            'title' => 'required|max:150|regex:/^[a-zA-Z0-9,#.-:? ]*$/',
            'description' => 'required',
        );
    

        $validator = \Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            
            return view('forum.thread_create')->withErrors($validator)
                                                ->with('forum_id',$forum_id);
        }else{

            if(!Auth::check()){

                return redirect('/login?redirect=/forum&id='.$forum_id.'&t_title='.$title.'&t_description='.$description);
            }
            // die('c');   
            $thread = new Thread;
            $thread->title=$title;
            $thread->description=$description;
            $thread->forum_id=$forum_id;
            $thread->user_id=Auth::id();
            $thread->save();

            return redirect('/threads/show_thread/'.$thread->id);
        }
    }


    public function thread_reply(Request $request,$id){
    	/*echo $request->reply;
    	echo $id;
    	die();*/
    	$thread_reply= new Thread_comment;


    	$thread_reply->thread_id=$id;
    	$thread_reply->user_id=Auth::id();
    	$thread_reply->comment=$request->reply;
    	$thread_reply->save();
    	return back();
    }
}
