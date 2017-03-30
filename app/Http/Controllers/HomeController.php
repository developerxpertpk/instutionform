<?php

namespace App\Http\Controllers;
use Auth;
use File;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        if(Auth::user()->role->role == 'admin'){
            return redirect()->to('admin/dashboard');
        }else{
            return view('home');
        }
    }    


   /*To Edit profile details of the current logged in  user*/
    public function profile_edit(Request $request){
        $rules=array(
                'fname' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'lname' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'email' => 'required|email|max:100|regex:/^[a-zA-Z0-9@_.]*$/',
                'address' => 'required|max:150|regex:/^[a-zA-Z0-9,#.-:]*$/',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return redirect('/home/my_profile')->withErrors($validator);
        } else {
            $result=DB::table('users')
                        ->where('id', Auth::id())
                        ->update([
                                'fname' => $request->input('fname'),
                                'lname' => $request->input('lname'),
                                'email' => $request->input('email'),
                                'address' => $request->input('address'),
                            ]);
            return redirect('/home/my_profile')->with('success','Updations Successful');
        }
    }



    /*To Change Password of the current logged in  user*/
    public function change_user_password(Request $request){
        $rules=array(
                'old_password' => 'required|max:50|regex:/^[a-zA-Z0-9@_.]*$/',
                'new_password' => 'required|min:6|regex:/^[a-zA-Z0-9@_.]*$/',
                'confirm_password' => 'required|min:6|regex:/^[a-zA-Z0-9@_.]*$/',
            );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect('/home/my_profile')->withErrors($validator);

        } else {

            if($request->input('new_password') != $request->input('confirm_password')){

                return redirect('/home/my_profile')->withErrors(array('cnf_pwd' => 'Confirmation password do not match'));

            }else{

                if(Hash::check($request->input('old_password'),Auth::user()->password)){
                $new_password=Hash::make($request->input('new_password'));

                DB::table('users')
                        ->where('id', Auth::id())
                        ->update([
                            'password' => $new_password,
                            ]);
                return redirect('/home/my_profile')->with('password_success','Password Updated Successful');
                }else{
                    return redirect('/home/my_profile')->withErrors(array('password_failed' => 'Old password did not matched'));
                }
            }
        }    
        // $password=bcrypt($request->input('old_password'));
        // if($password == Auth::user()->password){
        //     echo "match";
        // }else{
        //     echo "not match";
        // }
        // print_r(Auth::user()->password);
    }


    /*Function for Profile Picture Change*/
    public function change_dp_user(Request $request){

        $rules=array(
                'image' => 'required|image',
            );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect('/home/my_profile')->withErrors($validator);

        }else{

            $file = Input::file('image');

            $extention = $file->getClientOriginalExtension();

            if( $extention == 'jpg' || $extention == 'png' || $extention == 'jpeg' ){
                $fileName = $file->getClientOriginalName() ;
                
                $image_name=str_ireplace(" ","_",$fileName);

                $imagedata=explode("/",Auth::user()->image);
                $imagefolder=$imagedata[0];

                $path='upload/'.$imagefolder;
                $image_path=$imagefolder.'/'.$image_name;

                /*Check if image exists*/
                if (File::exists ( public_path ( $image_path ) ) ) {
                    //Overwrite Image name and path  
                    $image_name=$image_name.rand(5);
                    $image_path=$imagefolder.'/'.$image_name;   
                }
                
                $destinationPath = public_path($path);
                
                $file->move($destinationPath,$image_name);


                DB::table('users')
                        ->where('id', Auth::id())
                        ->update([
                                'image' => $image_path,
                            ]);
                return redirect('/home/my_profile');
            }else{
                return redirect('/home/my_profile')
                ->withErrors(array('image_error' => 'Image type must be of jpg, png or jpeg'));
            }
        }
    }





}
