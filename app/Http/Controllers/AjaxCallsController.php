<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class AjaxCallsController extends Controller
{

    /*For Retriving Nearby Locations*/
    public function retrive_nearby_locations(Request $request){

        $distance=100;
        $latitude=$request->latitude;
        $longitude=$request->longitude;


        $result=DB::select(DB::raw('SELECT locations.*,schools.* FROM locations,schools left join school_images on schools.id = school_images.id where locations.`id` = schools.location_id AND '.$distance.' >= ( ((ACOS( SIN( ('.$latitude.' * PI( ) /180 ) ) * SIN( (locations.latitude * PI( ) /180 ) ) + COS( ('.$latitude.' * PI( ) /180 )) * COS( (locations.latitude * PI( ) /180 )) * COS( (('.$longitude.' - locations.longitude) * PI( ) /180 )))) *180 / PI( )) *60 * 1.1515)'));

        return response($result); 
    }
    /*----close----*/



    /*check user status*/
    public function check_login(Request $request){

    	if(!Auth::check()){
    		return response()->json(false);
    	}

        $this->middleware('CheckStatus');

    	$id=Auth::id();
    	
    	return response()->json($id);
    	
    }
    /*----close----*/


    /*Rate School Functionality*/
    public function rate_school(Request $request){
    	$id=$request->id;
    	$rate=$request->rating;
    	return response($id);
    }
}
