<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\School_rating;
use App\School;
use App\User;
use Auth;
use Response;



class SchoolRatingReviewsController extends Controller
{
    public function index(Request $request){

        //        $school = DB::table('schools')
        //                    ->leftJoin('school_ratings', 'schools.id', '=', 'school_ratings.school_id')
        //                    ->addSelect(DB::raw('AVG(school_ratings.ratings) as average_rating'))
        //                    ->groupBy('schools.id')
        //                    ->orderBy('average_rating', 'desc')
        //                    ->get();
        //
        //        print_r($school);
        //        die('a');

        $paginate=School_rating::paginate(5);
        $school_data = School_rating::orderby('id','desc')->get();

        return view('admin.dashboard.school_rating_reviews.index',compact('school_data'
            ,'paginate'))
            ->with('i');


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

//        foreach ($school_data as $school) {
//
//            if($school->school_ratings){
//                die('v');
//                $sum= 0;
//                $rating=$school->school_ratings;
//
//                foreach($rating as $ratings){
//                    $sum+=$ratings->ratings;
//                }
//
//                $div= count($rating);
//
//                $avg_rating=round($rate/$div);
//
//                return view('admin.dashboard.school_rating_reviews.user_search')
//                    ->with('avg_rating',$avg_rating)
//                    ->with('school_data',$school_data)
//                    ->with('i');
//            }else{
//                die('a');
//                return view('admin.dashboard.school_rating_reviews.user_search')
//                            ->with('school_data',$school_data)
//                            ->with('i');
//            }
//        }


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
        $update = School_rating::where('id','=',$request->id)
            ->update(['reviews' => $request->reviews]);
        $school_rating = School_rating::find($request->id);
        return view('admin.dashboard.school_rating_reviews.edit',compact('school_rating'))
            ->with('success','Update Reviews Successfully');

    }

    // public funtion for show the ratings

    public function edit_ratings(Request $request){

        $school_id= $request->school_id;
        $user_id =$request->user_id;

        //return response($school_id);

        $school_user = School_rating::where([
            ['user_id', '=',  $user_id],
            ['school_id', '=', $school_id],
        ])->exists();

        if($school_user == true){

            $ratings = School_rating::select('ratings')->where([
                ['school_id','=',$school_id],
                ['user_id','=',$user_id]
            ])->first();
            return response($ratings);

        }else{
            return response()->json(false);
        }


    }

    // function to store the edit rating by admin

    public function submit_rating(Request $request){

        $ratings = $request->ratings;
        $school_id = $request->school_id;
        $user_id=$request->user_id;

        $school_user = School_rating::where([
            ['user_id', '=',  $user_id],
            ['school_id', '=', $school_id],
        ])->select('id')->first();

        $update = School_rating::where('id','=',$school_user->id)->update(['ratings' => $ratings]);

        if($update == true){
            $ratings = School_rating::where('id','=',$school_user->id)->select('ratings')->first();
            return  response($ratings);
        }else{
            $error ="Not Updated";
            return  response($error);
        }

    }
}
