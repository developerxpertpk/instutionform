<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class AjaxCallsController extends Controller
{

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
    /*close*/

    /*check user status*/
    public function check_status(Request $request){

    	if(!Auth::check()){
    		return response()->json(false);
    	}

    	$id=Auth::id();
    	
    	return response()->json($id);
    	
    }
}
