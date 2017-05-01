<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Threads_likes_dislike;
use App\Thread_comment_likes_dislike;
use App\Reported_thread;
use App\Reportedforum;
use App\Forum_likes_dislike;

class ForumajaxController extends Controller
{
    /*public function user_id(){
    	return Auth::id();
    }*/

    public function check_auth(){
    	return response()->json(true);
    }

    public function thread_like_dislike(Request $request){
    	$user_id = Auth::id();
    	// return response($this->user_id());

    	$thread_id=$request->thread_id;
    	$like_dislike=$request->like_dislike;

    	if(Threads_likes_dislike::where([
            ['user_id','=',$user_id],
            ['thread_id','=',$thread_id],
            ])->exists() ){

    		$update_thread=Threads_likes_dislike::where([
            ['user_id','=',$user_id],
            ['thread_id','=',$thread_id],
            ])->update(['is_liked_disliked' => $like_dislike]);

    	}else{
    		$thread_ld= new Threads_likes_dislike;
	    	$thread_ld->thread_id=$thread_id;
	    	$thread_ld->user_id=$user_id;
	    	$thread_ld->is_liked_disliked=$like_dislike;
	    	$thread_ld->save();

	    	if(!$thread_ld){
	    		return response()->json(false);
	    	}
    	}

    	
    	return response()->json(true);
    }

    public function thread_report(Request $request){
    	$thread_id=$request->thread_id;
    	$user_id=$request->user_id;
    	$report_reason=$request->report_reason;
    	$report_type=$request->report_type;


    	if(Reported_thread::where([
            ['user_id','=',$user_id],
            ['thread_id','=',$thread_id],
            ])->exists() ){

    		Reported_thread::where([
            ['user_id','=',$user_id],
            ['thread_id','=',$thread_id],
            ])->delete();

    	}else{

    		$reported_thread= new Reported_thread;
	    	$reported_thread->thread_id=$thread_id;
	    	$reported_thread->user_id=$user_id;
	    	$reported_thread->reporting_type=$report_type;
	    	$reported_thread->reporting_reason=$report_reason;
	    	$reported_thread->save();

	    	if(!$reported_thread){
	    		return response()->json(false);
	    	}
    	}

    	return response()->json(true);	
    }

    public function del_report(Request $request){
    	$thread_id=$request->thread_id;
    	$user_id=Auth::id();

    	if (Reported_thread::where([
    		['thread_id','=',$thread_id],
    		['user_id','=',$user_id],
    		])->exists()) {

    		$reported_thread= Reported_thread::where([
    		['thread_id','=',$thread_id],
    		['user_id','=',$user_id],
    		])->delete();

    		if (Reported_thread::where([
    			['thread_id','=',$thread_id],
    			['user_id','=',$user_id],
    			])->exists()) {

    			return response()->json(false);
    		}
    		return response()->json(true);
    	}

    	return response()->json(false);
    	
    }

    public function comment_like_dislike(Request $request){
    	$user_id = Auth::id();
    	// return response($this->user_id());

    	$thread_comment_id=$request->thread_comment_id;
    	$like_dislike=$request->like_dislike;

    	if(Thread_comment_likes_dislike::where([
            ['user_id','=',$user_id],
            ['thread_comment_id','=',$thread_comment_id],
            ])->exists() ){

    		$update_thread=Thread_comment_likes_dislike::where([
            ['user_id','=',$user_id],
            ['thread_comment_id','=',$thread_comment_id],
            ])->update(['is_liked_disliked' => $like_dislike]);

    	}else{

	    	$comment_ld= new Thread_comment_likes_dislike;
	    	$comment_ld->thread_comment_id=$thread_comment_id;
	    	$comment_ld->user_id=$user_id;
	    	$comment_ld->is_liked_disliked=$like_dislike;
	    	$comment_ld->save();

	    	if(!$comment_ld){
	    		return response()->json(false);
	    	}
	    }

    	return response()->json(true);
    }




/*FORUM LIKES DISLIKES REPORTS*/


    public function forum_like_dislike(Request $request){
    	$user_id = Auth::id();
    	// return response($this->user_id());

    	$forum_id=$request->forum_id;
    	$like_dislike=$request->like_dislike;

    	if(Forum_likes_dislike::where([
            ['user_id','=',$user_id],
            ['forum_id','=',$forum_id],
            ])->exists() ){

    		$update_forum=Forum_likes_dislike::where([
            ['user_id','=',$user_id],
            ['forum_id','=',$forum_id],
            ])->update(['is_liked_disliked' => $like_dislike]);

    	}else{
    		$forum_ld= new Forum_likes_dislike;
	    	$forum_ld->forum_id=$forum_id;
	    	$forum_ld->user_id=$user_id;
	    	$forum_ld->is_liked_disliked=$like_dislike;
	    	$forum_ld->save();

	    	if(!$forum_ld){
	    		return response()->json(false);
	    	}
    	}

    	
    	return response()->json(true);
    }

    public function forum_report(Request $request){
    	$forum_id=$request->forum_id;
    	$user_id=$request->user_id;
    	$report_reason=$request->report_reason;
    	$report_type=$request->report_type;


    	if(Reportedforum::where([
            ['user_id','=',$user_id],
            ['forum_id','=',$forum_id],
            ])->exists() ){

    		Reportedforum::where([
            ['user_id','=',$user_id],
            ['forum_id','=',$forum_id],
            ])->delete();

    	}else{

    		$reportedforum= new Reportedforum;
	    	$reportedforum->forum_id=$forum_id;
	    	$reportedforum->user_id=$user_id;
	    	$reportedforum->reporting_type=$report_type;
	    	$reportedforum->reporting_reason=$report_reason;
	    	$reportedforum->save();

	    	if(!$reportedforum){
	    		return response()->json(false);
	    	}
    	}

    	return response()->json(true);	
    }

    public function forum_del_report(Request $request){
    	$forum_id=$request->forum_id;
    	$user_id=Auth::id();

    	if (Reportedforum::where([
    		['forum_id','=',$forum_id],
    		['user_id','=',$user_id],
    		])->exists()) {

    		$reportedforum= Reportedforum::where([
    		['forum_id','=',$forum_id],
    		['user_id','=',$user_id],
    		])->delete();

    		if (Reportedforum::where([
    			['forum_id','=',$forum_id],
    			['user_id','=',$user_id],
    			])->exists()) {

    			return response()->json(false);
    		}
    		return response()->json(true);
    	}

    	return response()->json(false);
    	
    }
}
