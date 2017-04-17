<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\School_rating;
use App\School;
use App\User;

class School_rating_reviewsController extends Controller
{
    //
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

            $schools_name = School::where('school_name','LIKE','%'.$search.'%')->get();
           // $s = $schools_name->school_ratings();
            $s = $schools_name[0]->id;

            if(!empty($s)){
                $ratings = School_rating::where('school_id', '=', $s)->get();
                        return view('admin.dashboard.school_rating_reviews.search')
                            ->with('ratings', $ratings)
                            ->with('schools_name', $schools_name)
                            ->with('i', ($request->input('page', 1) - 1) * 5);
                    }else{
                        return redirect()->route('rating_reviews.index');
                    }

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
    public function show()
    {
        die('u r in show');
    }


}
