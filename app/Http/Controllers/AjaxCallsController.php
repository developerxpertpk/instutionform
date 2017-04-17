<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Input;
use App\School_rating;
use App\Bookmarked_school;


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

    	$school_id=$request->school_id;
    	$rate=$request->rating;

        // return response()->json($rate);

        if(School_rating::where([
            ['user_id','=',Auth::id()],
            ['school_id','=',$school_id],
            ])->exists() ){

           $rating= School_rating::where([
            ['user_id','=',Auth::id()],
            ['school_id','=',$school_id],
            ])->select('ratings')->first();   

           return response($rating);
           // return response('Do nothing');
        }else{
            $ratings= new School_rating;

            $ratings->school_id = $school_id;
            $ratings->user_id = Auth::id();
            $ratings->ratings = $rate;
            $ratings->save();

            return response()->json(true);
        }
        
    }


    /*For checking user rating on a current school*/
    public function check_rate(Request $request){

        $school_id=$request->school_id;


        if(!Auth::check()){
            return response()->json(false);
        }

        $this->middleware('CheckStatus');

        if ( School_rating::where([
                ['user_id','=',Auth::id()],
                ['school_id','=',$school_id]
            ] )->exists() ) {

            $rating=School_rating::select('ratings')->where( [
                ['user_id','=',Auth::id()],
                ['school_id','=',$school_id]
            ] )->first();

            return response($rating);
        }
        return response()->json('not exist');
    }


    public function check_bookmark(Request $request){
        $school_id=$request->school_id;

        if(!Auth::check()){
            return response()->json(false);
        }

        $this->middleware('CheckStatus');

        $bookmarked= new Bookmarked_school;

        if( Bookmarked_school::where([
                ['user_id','=',Auth::id()],
                ['school_id','=',$school_id]
            ] )->exists()){

            Bookmarked_school::where([
                ['user_id','=',Auth::id()],
                ['school_id','=',$school_id]
            ] )->delete();

            return response('deleted');
        }

        

        $bookmarked->school_id = $school_id;
        $bookmarked->user_id = Auth::id();
        $bookmarked->save();       

        return response('saved');

    }
}
