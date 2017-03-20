<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\Request;
use Auth;
use App\User;
use Redirect;

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
        $this->middleware('guest', ['except' => 'logout']);
    }


    public function login(){
        // store email and password in variables
        $email=$_POST['email'];
        $password=$_POST['password'];

        // using attemp()
        if(Auth::attempt(array('email'=> $email,'password' => $password)))
            {  
                // validate() is use to validate user 
                if (Auth::validate(['email'=>$email, 'password'=>$password, 'status' => '1'])) {  
                   //   echo "u r no t allowed";
                      Auth::logout();
                      return redirect()->to('/');
                     
                }else{
                    
                     if(Auth::user()->role_id == '2' && Auth::user()->status =='0')
                        {   
                            return redirect()->to('home');
                        }   

                }

                // check admin role id == 1
                if(Auth::user()->role_id == '1')
                {   
                   return Redirect::to('admin/dashboard');
                }
                //check  user role id 2    
            }else{
                    //if no email and password match then redirect to registration
                return redirect::to('user_register');
            }
          
    }

        // function show login form
    public function showLoginForm(){

        return view('auth.login');
    }

    public function logout(){
        
                if(Auth::user()->role_id == '1'){
                    Auth::logout();
                    return redirect()->to('admin/login');
                }else{
                    Auth::logout();
                    return redirect()->to('login');
                }
    }


                // if(Auth::check()){
                //    echo "yes";
                // }
                // else{
                //     echo "no";
                // }
               
                // //print_r(Auth::user());
                // die('a');
                  // Auth::user()->role_id;
                    // user dashboard      
                    //die('b');

}