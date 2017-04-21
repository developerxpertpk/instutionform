<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Forum;
use App\Threads_likes_dislike;
use Auth;

class FrontendforumController extends BaseController
{

    /*The Index page of Forum with forums & threads data*/
    public function forum_index(){

        $forums=Forum::paginate(10);
        $popular_thread=Threads_likes_dislike::groupBy('thread_id')
                                ->selectRaw('sum(is_liked_disliked) as likes, thread_id')
                                ->orderBy('likes','desc')
                                ->take(5)
                                ->get();

    	return view('forum.forum_index')->with('forums',$forums)
                                        ->with('popular_threads',$popular_thread);
    }



    /*For Displaying create forum and existing forums*/
    public function createForumView($id){

    	if(is_numeric($id)){
            
    		$school_data=School::find($id)->first();
    		return view('forum.forum_create')->with('schooldata',$school_data)
                                            ->with('school_id',$id);
    	}
    	$schools=School::all();
    	return view('forum.forum_create')->with('schools',$schools);
    }



    /*For submitting Forum*/
    public function createforum(Request $request){

        if( count( $request->all() ) ){
            $title = $request->title;
            $description = $request->description;
            $school_id= empty($request->school_id) ? $request->school_select_id : $request->school_id;
        }else{
            $title = $_GET['title'];
            $description =  $_GET['description'];
            $school_id= $_GET['id'];
        }
        
        if(!Auth::check()){

            return redirect('/login?redirect=/forum&id='.$school_id.'&title='.$title.'&description='.$description);
        }

        $rules=array(
                'title' => 'required|max:150|regex:/^[a-zA-Z0-9,#.-:? ]*$/',
                'description' => 'required|regex:/^[a-zA-Z0-9,#.-:@<>]*$/',
            );

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $error=$validator->messages()->getMessages();
            $errors=array();
            foreach ($error as $field_name => $messages)
            {
                // print_r($messages);
                foreach( $messages as $message){
                    // print_r($message);
                    $errors[$field_name]=$message;
                }
            }
            // print_r($errors);
            return view('forum.forum_create')->with('error',$errors)
                                            ->with('schooldata',$school_id);
        } else {

            $forum = new Forum;
            $forum->title=$title;
            $forum->description=$description;
            $forum->school_id=$school_id;
            $forum->user_id=Auth::id();
            $forum->save();

            return redirect('/forum');
        }

    }




    public function show_forum($id){
        // die('here');
        // die('show_forum');
        // echo "<pre>";
        if(!is_numeric($id)){
            return redirect($id);
        }

        $forum=Forum::find($id)->first();
        // print_r($forum);
        return view('forum.view_forum')->with('forum',$forum);
    }

}
