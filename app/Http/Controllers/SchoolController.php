<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;	
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\School;
use App\School_image;
use App\location;


class SchoolController extends Controller
{
    //
    public function index(Request $request){
      $schools=DB::table('schools')->where('id','1')->first();
      $locations=DB::table('locations')->where('id','1')->first();
      echo "<pre>";
      print_r($locations);
      $schools=schools()->locations;
       $schools = Location::find(1)->id;
        print_r($schools);
      die('a');
    	return view('admin.dashboard.school.index',compact('schools'))
          ->with('i', ($request->input('page', 1) - 1) * 5);
    
    }

    public function store(Request $request){

       // validation on input data
    	
         $rules = array(
        'school_name' => 'required|min:3|alpha',
        'address' => 'required|min:3|alpha',
        'country' => 'required|min:1|max:50|',
        'state' =>   'required|min:5|alpha',
        'city' => 'required|alpha|min:5'
    );
    $validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
				return redirect()->to('admin/school')
            ->withErrors($validator)
            ->withInput();
		}

		/*  make model objects */
		 $location= new Location(); /*location object*/
		 $school= new School(); /*  School object*/
		 $image= new School_image();   
		


        // check weather request has image path or not
        if($file = $request->hasFile('image')) { 

                       $file = $request->file('image');
                       $fileName = $file->getClientOriginalName() ;
                       $extention = $file->getClientOriginalExtension();
                       $destinationPath = public_path().'/upload/' ;
                       $file->move($destinationPath,$fileName);
                     
                 }
         $location->country = $request['country'];
         $location->state = $request['state'];
         $location->city = $request['city'];
                                     
         $location->save();
       
      	 $school->location_id=$location->id;
      	 $school->school_name=$request['school_name'];
      	 $school->school_address=$request['school_address'];

      	 $school->save();

      	 $image->school_id=$school->id;
      	 $image->image=$request['image'];

      	 $image->save();

	}
    
    
}
