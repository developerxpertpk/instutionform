<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\School;
use App\Location;

class UnregisteredController extends Controller
{
    /*Homepage Search Location*/
    public function search_location_school(Request $request){

        if(Input::has('location') && Input::has('school_name')){
            /*Location and school name are filled*/

            $location=Input::get('location');
            $school_name=Input::get('school_name');

            $schools_byName = School::where('school_name','LIKE','%'.$school_name.'%')
						                    ->orderBy('school_name')
						                    ->get();

			$schools_byLocation = Location::where('country','LIKE','%'.$location.'%')
                    ->orWhere('state', 'LIKE', '%'. $location .'%')
                    ->orWhere('city', 'LIKE', '%'. $location .'%')
                    ->orderBy('city')
                    ->get();
            
            return view('forum&finder_welcome')->with('schools_byName',$schools_byName)
            					->with('schools_byLocation',$schools_byLocation)
                                ->with('message_1',$location)
                                ->with('message_2',$school_name);

        }elseif(Input::has('school_name')){
            /*School name is filled*/

            $school_name=Input::get('school_name');

            $schools_byName = School::where('school_name','LIKE','%'.$school_name.'%')
						                    ->orderBy('school_name')
						                    ->get();

			return view('forum&finder_welcome')->with('schools_byName',$schools_byName)
                                                ->with('message_2',$school_name);

        }elseif(Input::has('location')){
        	/*location is filled*/

        	$location=Input::get('location');

            $schools_byLocation = Location::where('country','LIKE','%'.$location.'%')
                    ->orWhere('state', 'LIKE', '%'. $location .'%')
                    ->orWhere('city', 'LIKE', '%'. $location .'%')
                    ->orderBy('city')
                    ->get();

			
            return view('forum&finder_welcome')->with('schools_byLocation',$schools_byLocation)
                                                ->with('message_1',$location);
       
        }else{
        	return redirect('/')->with('search_failed','Please Enter a Schoool');
        }
    }


    /*For Showing a particular school */
    public function show_school($id){
        echo "under construction";
    }

    /*For Showing all Schools*/
    public function schools_list(){
        $schools=School::all();
        $schools_latest=School::all()
                        ->sortByDesc('created_at');

        return view('user.guests.list_of_schools')->with('schools',$schools)
                                                    ->with('schools_latest',$schools_latest);
    }
}
