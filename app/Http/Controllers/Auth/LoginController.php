<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Request;
use Route;
use Auth;
use App\User;
use Redirect;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
   /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */
   
   /**
   * Where to redirect users after login.
   *
   * @var string
   */

   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
      $this->middleware('check.status', ['except' => 'logout']);
      $this->middleware('guest', ['except' => 'logout']);
   }


   public function login(){
      // store email and password in variables

      $email=$_POST['email'];
      $password=$_POST['password'];

      if(Auth::attempt(array('email'=> $email,'password' => $password)))
      {  
          
         // validate() is use to validate user is blocked  if status 1= blocked
         if(Auth::validate(['email'=>$email, 'password'=>$password, 'status' => '1'])){  
            //   echo "u r no t allowed";
            Auth::logout();
            return redirect()->to('/');
            
         }

         /*For Forum Query String Redirections*/
         if(Input::has('redirect')){

            if( Input::has('redirect') && isset( $_GET['title'] ) ){
               // die('a');

               return Redirect::route('create_forums', array(
                  'title' => $_GET['title'],
                  'description' => $_GET['description'],
                  'school_id' => $_GET['id'],
                  ));
            }

            return redirect( Input::get('redirect') );
         }

         //check  user role id 2 
         if(Auth::user()->role_id == '2' || Auth::user()->status =='0') {  
            return redirect()->to('home');
         }  

         // check admin role id == 1
         if(Auth::user()->role_id == '1'){   
            return Redirect()->to('admin/dashboard');
         } 
      }else{
         //if no email and password match then redirect to registration
         return view('auth.register');
      }
       
   }

   // function show login form
   public function showLoginForm(){

      if(Input::has('redirect')){
         $redirect = Input::get('redirect');
         return view('auth.login')->with('redirect',$redirect);   
      }
      return view('auth.login');
   }

   public function logout(){
                 Auth::logout();
                 return redirect()->to('login');
   }

}
