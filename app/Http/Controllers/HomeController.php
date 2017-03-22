<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    /*To Change Password of the current logged in  user*/
    public function change_user_password(Request $request){
        if(Hash::check($request->input('old_password'),Auth::user()->password)){
            $new_password=Hash::make($request->input('new_password'));

            DB::table('users')
                    ->where('id', Auth::id())
                    ->update([
                        'password' => $new_password,
                        ]);
            return redirect('/home/my_profile')->with('password_success','Password Updated Successful');
        }else{
            return redirect('/home/password_user')->with('password_failed','Old password did not matched');
        }
        // $password=bcrypt($request->input('old_password'));
        // if($password == Auth::user()->password){
        //     echo "match";
        // }else{
        //     echo "not match";
        // }
        // print_r(Auth::user()->password);
    }
}
