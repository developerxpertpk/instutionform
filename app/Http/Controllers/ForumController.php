<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Forum;
use App\School;
use App\User;
use App\Reportedforum;

class ForumController extends Controller
{
    //

    public function index(){
        $forum_data = Forum::orderby('id','desc')->get();
        return view('admin.dashboard.forum.index',compact('forum_data'))
                     ->with('i');
    }

    public function destroy($id){
         Forum::find($id)->delete();
         return redirect()->route('forum.index')
                           ->with('success','Forum data deleted Successfully');


    }
    public function reported_search(Request $request){
        $f =Forum::all();
        $r= Reportedforum::all();
        $search = $request->all();
         //$a[] = Reportedforum::forums()->title;
         //$b =Reportedforum::users()->fname;

        $title = Forum::where('title','LIKE','%'.$search.'%')
            ->orderBy('id')
            ->get();

    }








}
