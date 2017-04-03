<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\School;
use App\Location;
use Illuminate\Support\Facades\DB;

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

        $particular_school=School::where('id','=',$id)->get();
        return view('user.guests.view_school')->with('particular_school',$particular_school);
        //echo "under construction";
    }



    /*For Showing all Schools*/
    public function schools_list(){
        $schools=School::all();
        $schools_latest=School::all()
                        ->sortByDesc('created_at');

        $schools_oldest=School::all()
                        ->sortBy('created_at');

        return view('user.guests.list_of_schools')->with('schools',$schools)
                                                    ->with('schools_latest',$schools_latest)
                                                    ->with('schools_oldest',$schools_oldest);
    }


    /*For Retriving Nearby Locations*/
    public function retrive_nearby_locations(Request $request){

        //print_r($request);
        //$response=$request->all();
        $distance=10;
        $latitude=$request->latitude;
        $longitude=$request->longitude;
        $result=DB::raw('SELECT locations.*,schools.* FROM locations,schools where locations.`id` = schools.location_id AND '.$distance.' >= ( ((ACOS( SIN( ('.$latitude.' * PI( ) /180 ) ) * SIN( (locations.latitude * PI( ) /180 ) ) + COS( ('.$latitude.' * PI( ) /180 )) * COS( (locations.latitude * PI( ) /180 )) * COS( (('.$longitude.' - locations.longitude) * PI( ) /180 )))) *180 / PI( )) *60 * 1.1515)');

        $response=$request->city;

        if(count($result)){
            return response()->json(false);
        }else{
            return response()->json([$result]);
        }
        
        //['response' => 'This is post method']
        //return response()->json($result); 
    }
}
