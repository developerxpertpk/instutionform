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
    public function index(){
    	return view('admin.dashboard.school.index');
    }

    public function store(Request $request){

        // validation on input data
  //        $rules = array(
  //       'school_name' => 'required|min:3|alpha',
  //       'address' => 'required|min:3|alpha',
  //       'country' => 'required|min:1|max:50|',
  //       'state' =>   'required|min:5|alpha',
  //       'city' => 'required|alpha|min:5'
  //   );
  //   $validator = Validator::make(Input::all(), $rules);

		// if($validator->fails()){
		// 		return redirect()->to('admin/school')
  //           ->withErrors($validator)
  //           ->withInput();
		// }

		/*  make model objects */

		 $school= new School(); /*  School object*/
		 $image= new School_image();   
		 $location= new Location(); /*location object*/


        // check weather request has image path or not
        if($file = $request->hasFile('image')) { 

                       $file = $request->file('image');
                       $fileName = $file->getClientOriginalName() ;
                       $extention = $file->getClientOriginalExtension();
                       $destinationPath = public_path().'/upload/' ;
                       $file->move($destinationPath,$fileName);
                     
                 }
             
            echo  	$school->school_name = $request['school_name'];
            echo    $school->school_address = $request['school_address'];
            echo    $image->image = $fileName;
            echo    $loc_country->country = $request['country'];
            echo    $loc_state->state = $request['state'];
            echo    $loc_city->city = $request['city'];
                                             
               	$location->save();

        }
    
    
}
