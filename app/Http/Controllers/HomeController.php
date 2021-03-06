<?php

namespace App\Http\Controllers;
use Auth;
use File;
use App\User;
use App\Page;
use Illuminate\Support\Facades\View;
use App\Bookmarked_school;
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
        $page = Page::orderBy('id','DESC')->where('active','=',0)->get();
        View::share('page', $page);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        
        /*if(Auth::user()->role->role == 'admin'){
            return redirect()->to('admin/dashboard');
        }else{*/
        $bookmarked_schools=Bookmarked_school::where('user_id','=',Auth::id())->paginate(15);
        return view('user.user_bookmarks')->with('bookmarked_schools',$bookmarked_schools);
        // }
    }    

    public function my_profile(){
        return view('user.my_profile');
    }


   /*To Edit profile details of the current logged in  user*/
    public function profile_edit(Request $request){
        $rules=array(
                'fname' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'lname' => 'required|max:100|regex:/^[\pL\s]+$/u',
                'email' => 'required|email|max:100|regex:/^[a-zA-Z0-9@_.]*$/',
                'address' => 'required|max:150|regex:/^[a-zA-Z0-9,#.-: ]*$/',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $result=User::find(Auth::id());

            $result->fname=$request->input('fname');
            $result->lname=$request->input('lname');
            $result->email=$request->input('email');
            $result->address=$request->input('address');
            $result->save();

            return back()->with('success','Updations Successful');
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

            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            if($request->input('new_password') != $request->input('confirm_password')){

                return redirect()->back()->withErrors(array('cnf_pwd' => 'Confirmation password do not match'));
                /*return view('user.my_profile')->withErrors(array('cnf_pwd' => 'Confirmation password do not match'));*/

            }else{

                if(Hash::check($request->input('old_password'),Auth::user()->password)){

                    $new_password=Hash::make($request->input('new_password'));
                    $result=User::find(Auth::id());
                    $result->password=$new_password;
                    $result->save();

                    return back()->with('password_success','Password Updated Successful');
                    // return view('user.my_profile')->with('password_success','Password Updated Successful');
                }else{
                    return redirect()->back()->withErrors(array('password_failed' => 'Old password did not matched'));
                    // return view('user.my_profile')->withErrors(array('password_failed' => 'Old password did not matched'));
                }
            }
        }
    }


    /*Function for Profile Picture Change*/
    public function change_dp_user(Request $request){

        $rules=array(
                'image' => 'required|image',
            );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = Input::file('image');

        $extention = $file->getClientOriginalExtension();

        if($extention == 'jpg' || $extention == 'png' || $extention == 'jpeg' ){
            
            $fileName = $file->getClientOriginalName();

            $insert =User::find(Auth::id());
        
            $userfolder_path = 'upload/users/user'.'_'.Auth::id().'/images/profile_pic/current_dp';
            $userfolder_path_1 = 'upload/users/user'.'_'.Auth::id().'/images/profile_pic';
            
            $destinationPath = public_path().'/'.$userfolder_path;
            $destinationPath_1 = public_path().'/'.$userfolder_path_1;

            /*Check for folder existance*/
            if (!File::exists($destinationPath)){
              File::makeDirectory($destinationPath, 0777, true);
            }

            if(File::exists($destinationPath.'/'.Auth::user()->image)){
                File::delete($destinationPath.'/'.Auth::user()->image);
            }

            $file->move($destinationPath,$fileName);
            //  copy image in profile pic folder
            $copy = File::copy($destinationPath.'/'.$fileName,$destinationPath_1.'/'.$fileName);

            $insert->image = $fileName;
            $insert->save();

            return back();
        }else{
            return redirect()->back()->withErrors(array('image_error' => 'Image type must be of jpg, png or jpeg'));
        }
    }
}
