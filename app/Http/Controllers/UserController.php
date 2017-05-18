<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use App\User;
use Auth;
use Validate;
use File;


class UserController extends Controller
{
    // controller to retrive the data from database and show data

    	/* function for users */
    public function Index(Request $request){  
        // this function is use to retrive data from database
        $users = User::orderBy('id','DESC')->paginate(5);
        return view('admin.dashboard.user.index',compact('users'))
                    ->with('i', ($request->input('page', 1) - 1) * 5);

    }


	public function create()
    {
        return view('admin.dashboard.user.create');
    }

    public function store(Request $request){

                $this->validate($request, [
                    'fname' => 'required|max:255',
                    'lname' => 'required',
                    'email' => 'required|email|max:255|unique:users',
                    'gender' => 'required',
                    'address' =>'required',
                ]);

                $insert =new User();
                // check weather request has image path or not
                if($file = $request->hasFile('image')){

                    $this->validate($request, [
                        'image'=>'image|max:200000',
                    ]);
                    $result=DB::select("SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".env('DB_DATABASE')."' AND TABLE_NAME = 'users'");
                    $user_id=$result[0]->AUTO_INCREMENT;

                    $file = $request->file('image');
                    $fileName = $file->getClientOriginalName();
                    $destinationPath = public_path().'/upload/users/user_'.$user_id.'/images/profile_pic/current_dp/';
                    $destinationPath_1 = public_path().'/upload/users/user_'.$user_id.'/images/profile_pic/';

                    // path does not exist
                    if (!file_exists($destinationPath)){
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }
                    //move file
                    $image=  $file->move($destinationPath, $fileName);
                    //copy file
                    $copy = File::copy($destinationPath.'/'.$fileName,$destinationPath_1.'/'.$fileName);
                    $insert->image =  $fileName ;
                }

                $insert->fname = $request['fname'];
                $insert->lname = $request['lname'];
                $insert->email = $request['email'];
                $insert->password = bcrypt($request['password']);
                $insert->gender = $request['gender'];
                $insert->address = $request['address'];
                $insert->save();
                return redirect()->route('user.index')
                ->with('success','Item created successfully');
        }

    //userShow() is use to show the particular user profile
	public function show($id){
		$user = User::find($id);	
        return view('admin.dashboard.user.show',compact('user'));
    }


	public function edit($id){

		$user = User::find($id);
        return view('admin.dashboard.user.edit',compact('user'));
	}

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index')
                        ->with('success','Data Deleted successfully');
    }

    public function status_update(Request $request,$id){

        if($request['status'] == 0){

            $status = User::Where('id','=',$id)->first();
            $status->status = $request['status'];
            $status->save();

        return redirect()->route('user.index')
                        ->with('success','User Unblocked Successfully');
        }

        if($request['status'] == 1){
            $status = User::Where('id','=',$id)->first();
            $status->status = $request['status'];
            $status->save();

           return redirect()->route('user.index')
                            ->with('success','user blocked successfully');
        }  
    }



    static function search(Request $request)
    {
            
            $user = User::all();
            $search = $request->input('search');
             // if serach bar is not empty
             if(!empty($search)){
                
                $users = User::where('fname','LIKE','%'.$search.'%')
                            ->orWhere('lname', 'LIKE', '%'. $search .'%')
                            ->orWhere('email', 'LIKE', '%'. $search .'%')
                            ->orderBy('fname')
                            ->paginate('5');


                if(!$users->isEmpty()){

                    return view('admin.dashboard.user.search',compact('users'))
                            ->with('i', ( $request->input('page', 1) - 1) * 5)
                            ->with('success',' data found');

                }else{    

                    return view('admin.dashboard.default')
                            ->with('success','Sorry data not found');
                    }
             }else{  
                              
                return redirect()->route('user.index')
                                ->with('success','Please Enter Name/email to find result ');

                }

            }

        public function user_update(Request $request,$id)
        {
            // validate Input
            $this->validate($request, [
                'fname' => 'required|max:255',
                'lname' => 'required',
                'email' => 'required|email|max:255',
                'gender' => 'required',
                'address' =>'required',
            ]);
            //create object
            $object = User::find($id);

            if($file = $request->hasFile('image')){
                $this->validate($request, [
                    'image'=>'image|max:200000',
                ]);
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path().'/upload/users/user_'.$id.'/images/profile_pic/current_dp/';
                $destinationPath_1 = public_path().'/upload/users/user_'.$id.'/images/profile_pic/';
                // path does not exist
                if (!file_exists($destinationPath)){
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                 }

                //move file
                $image=  $file->move($destinationPath, $fileName);
                //copy file
                $copy = File::copy($destinationPath.'/'.$fileName,$destinationPath_1.'/'.$fileName);
                //deleting the existing dp
                File::delete($destinationPath.'/'.$object->image);
                $object->image =$fileName;
            }
            $object->fname =$request->fname;
            $object->lname =$request->lname;
            $object->email =$request->email;
            $object->gender =$request->gender;
            $object->address =$request->address;
            $object->save();

            if($object->role_id=='1')
            {
                return view('admin.dashboard.profile');
            }

            return redirect()->route('user.index')
                ->with('success','user updated successfully');
        }

}   
