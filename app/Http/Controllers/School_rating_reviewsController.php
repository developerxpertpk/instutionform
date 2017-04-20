<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\School_rating;
use App\School;
use App\User;
use Auth;


class School_rating_reviewsController extends Controller
{

    public function index(Request $request){

        $schools_rating = School_rating::orderBy('id', 'desc')->get();
        return view('admin.dashboard.school_rating_reviews.index',compact('schools_rating'))
                         ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    public function destroy($id){

        School_rating::find($id)->delete();
        return redirect()->route('school_rating.index')
                            ->with('success','Rating and reviews deleted successfully');

        }

    public function school_search(Request $request){

        $school_rating = School_rating::all();
        $school = School::all();
        $search = $request->input('search');
        // if serach bar is not empty
        if(!empty($search)){
            $schools_name = School::where([  ['school_name','LIKE','%'.$search.'%'] ])->get();

            return view('admin.dashboard.school_rating_reviews.search',compact('schools_name'))
                        ->with('i');
        }else{
            return view('admin.dashboard.default')
                ->with('success','Sorry data not found');

        }
        return redirect()->route('rating_reviews.index');

    }

    public function edit($id)
    {
        $school_rating = School_rating::find($id);
        return view('admin.dashboard.school_rating_reviews.edit',compact('school_rating'));
    }

    public function show(Request $request,$id)
    {
      // Show function is used to show the list of ratings and reviews given a particuler user

        $school_data = School_rating::where( 'school_id','=',$id)->get();
            return view('admin.dashboard.school_rating_reviews.user_search', compact('school_data'))
                ->with('i');

    }

    public function store(Request $request){
         $s = $request->all();
         // Make object of ReportedForum
        $rating = new School_rating;

        $review_id = School_rating::where('school_id','=',$request->school_id)
                            ->where('user_id' ,'=',Auth::user()->id)
                            ->first();
        if($review_id == true) {
            $update = School_rating::where('id', '=', $review_id->id)
                ->update(['reviews' => $request->reviews]);
            return redirect()->route('school.show',$request->school_id)
                ->with('success', 'Thanks for your ratings');
        }else{
            $rating->school_id = $request->school_id;
            $rating->user_id = Auth::user()->id;
            $rating->reviews = $request->reviews;
            $rating->save();
            return redirect()->route('school.show',$request->school_id)
                ->with('success', 'Thanks for your ratings');
        }


    }

    //function to update Reviews of user

    public function  update_review(Request $request,$id){

        $update = School_rating::where('id', '=',$request->id)
                  ->update(['reviews' => $request->reviews]);
        $school_rating = School_rating::find($request->id);
        return view('admin.dashboard.school_rating_reviews.edit',compact('school_rating'))
                        ->with('success','Update Reviews Successfully');

    }

}
