<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
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
        // if(Auth::check()){
        //     echo "yes";
        //     die('a');
        // }else{
        //     echo "no";
        //      die('b');
        // }
        // die('a');
        
        if(Auth::user()->role->role == 'admin'){
            return redirect()->to('admin/dashboard');
        }else{
            return view('home');
        }
    }    


   /*To Edit profile details of the current logged in  user*/
    public function profile_edit(Request $request){
        $rules=array(
                'fname' => 'required|max:100',
                'lname' => 'required',
                'email' => 'required|email|max:100',
                'address' => 'required|max:150',
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
                'old_password' => 'required|max:50',
                'new_password' => 'required|max:50',
                'confirm_password' => 'required|max:50',
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
                'image' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect('/home/my_profile')->withErrors($validator);

        } else {

                $file = Input::file('image');
                $fileName = $file->getClientOriginalName() ;
                /*$extention = $file->getClientOriginalExtension();*/
                $fileName=str_ireplace(" ","_",$fileName);

                $name=Auth::user()->fname."_".Auth::user()->lname."_".Auth::user()->email;
                

                $user_folder_=str_ireplace(" ","_",Auth::user()->email);
                
                $destinationPath = public_path().'/upload/'.$school_folder.'/';
                
                $pic_existance=DB::table('school_images')
                                            ->where(['photo_path' => $school_folder.$fileName]);

                $school_id=DB::table('schools')
                                        ->orderBy('id', 'desc')
                                        ->limit(1)
                                        ->select('id')
                                        ->get();

                foreach($school_id as $school){
                        $s_id=$school->id;
                }
                
                if($pic_existance->count()){

                    $random_number=rand();


                    $fileName_new=$random_number.$fileName;

                    $file->move($destinationPath,$fileName_new);

                    DB::table('school_images')->insert([
                            'school_id' => $s_id,
                            'photo_path' => $school_folder.$fileName_new,
                        ]);
                    return Redirect::to('/admin/tables')
                            ->with('success','School Is Successfully Registered');
                }else{

                    DB::table('school_images')->insert([
                            'school_id' => $s_id,
                            'photo_path' => $school_folder.$fileName,
                        ]);

                    return Redirect::to('/admin/tables')
                            ->with('success','School Is Successfully Registered');
                }
            }
    }


}
