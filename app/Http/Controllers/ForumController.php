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

    public function show($id){
        $show_data = Forum::find($id);
        return view('admin.dashboard.forum.view',compact('show_data'))
            ->with('i');

    }
    public function reported_search(Request $request){
        $f =Forum::all();
        $r= Reportedforum::all();
        $search = $request->all();

        $search_data = Reportedforum::where('reporting_type','=',$search)->get();
        if(!$search_data->isEmpty()) {
            return view('admin.dashboard.forum.search', compact('search_data'))
                ->with('i');
        }else{
            return view('admin.dashboard.default')
                ->withError('oops Sorry !!! , No data Found');
        }
    }

    public function reported_delete($id){

        Reportedforum::find($id)->delete();

        return view('admin.dashboard.forum.search')
                    ->with('success','Reported forum deleted  successfully');
        }


}
