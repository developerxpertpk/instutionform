<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\School_rating;
use App\Location;
use App\School;
use Session;
use Auth;

class UnregisteredController extends BaseController
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

        if(!is_numeric($id)){
            return redirect($id);
        }

        // die('show_school');
        
        $particular_school=School::where('id','=',$id)->get();

        foreach ($particular_school as $school) {
            if(!$school->school_ratings->isEmpty()){

                $rating=$school->school_ratings;
                $rate= 0;

                foreach($rating as $ratings){
                    $rate+=$ratings->ratings;
                }

                $div= count($rating);

                $avg_rating=round($rate/$div);

                return view('user.guests.view_school')
                                        ->with('avg_rating',$avg_rating)
                                        ->with('particular_school',$particular_school);
            }else{
                return view('user.guests.view_school')->with('particular_school',$particular_school);
            }
        }
        
        return view('user.guests.view_school')->with('particular_school',$particular_school);
    }
    /* /Close*/



    /*For Showing all Schools*/
    public function schools_list(){
        $schools=School::all();
        $schools_latest=School::all()
                        ->sortByDesc('created_at');

        $schools_oldest=School::all()
                        ->sortBy('created_at');

        $popular_schools=School_rating::having(DB::raw('avg(ratings)'),'>',4.5)->groupBy('school_id')->orderBy(DB::raw('avg(ratings)'))->get();
        // echo "<pre>";
        // print_r($popular_schools);
        
        // die();

        $lowest_rated_schools=School_rating::having(DB::raw('avg(ratings)'),'<',4.5)->groupBy('school_id')->orderBy(DB::raw('avg(ratings)'))->get();

        return view('user.guests.list_of_schools')->with('schools',$schools)
                                                    ->with('schools_latest',$schools_latest)
                                                    ->with('schools_oldest',$schools_oldest)
                                                    ->with('popular_schools',$popular_schools)
                                                    ->with('lowest_rated_schools',$lowest_rated_schools);
    }
    /* /Close */


    /*For confirming login on Review or rating */
    public function review_confirm(Request $request){

        $rules=[
            'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9@_.]*$/',
            'password' => 'required|min:6|regex:/^[a-zA-Z0-9@_.]*$/',
        ];

        $validator = Validator::make($request->all(), $rules);
        

        if($validator -> fails()){
            
            Session::flash('failed','Enter valid credentials');
            return back()->withErrors($validator);
        }


        if(Auth::attempt(array('email'=> $request->input('email'),'password' => $request->input('password')))){

            if($request->session()->has('failed')){
                $request->session()->forget('failed');
            }
            return redirect(url()->previous());
        }else{
            Session::flash('failed','Your credentials didn\'t match our records ');
            return redirect(url()->previous());
        }
    }
    /* /Close*/


    public function post_review(Request $request){

        if(!$request->input('review')){
            Session::flash('empty_review','Please enter a review');
            return back();
        }

        if(!Auth::check()){
            Session::flush();
            Session::flash('Login','You Must Login First');
            return back();
        }

        if(School_rating::where('user_id','=',Auth::id())->exists() ){
            
                School_rating::where('user_id','=',Auth::id())->update(array('reviews' => $request->input('review')));
                return back();
        }else{
            Session::flash('rate_error','You must rate first');
            return back();
        }

    }


    /*SHARE VIA EMAIL*/
    public function share_via_email(Request $request){
        $validator = Validator::make($request->all(),[
                'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9@_.]*$/',
            ]);

        if($validator -> fails()){
            Session::flash('send_failed','Enter valid email address');
            return back()->withErrors($validator);
        }
        
        $userEmail = array();

        $userEmail['email'] = $request->email;
         $userEmail['url'] = $request->url;

        Mail::send('mail_template.share_school', $userEmail, function ($message) use ($userEmail) {
            $message->to($userEmail['email'])
                    ->subject('School Share');
        });

        if(count(Mail::failures()) > 0 ){
            
            echo "failed";
            foreach(Mail::failures() as $email_address) {
                echo $email_address."<br />";
            }
        
        }else{
            Session::flash('sent_success','Mail has been sent successfully.');
            return back();
        }
    }
}