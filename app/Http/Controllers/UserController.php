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
                    'fname' => 'required',
                    'lname' => 'required',
                    'email' => 'required',
                    'gender' => 'required',
                    'address' =>'required',
                ]);

                $insert =new User();

                // check weather request has image path or not

                if($file = $request->hasFile('image')) { 

                    $file = $request->file('image');
                    $fileName = $file->getClientOriginalName() ;
                    $extention = $file->getClientOriginalExtension();
                    $destinationPath = public_path().'/upload/' ;
                    $file->move($destinationPath,$fileName);
                }

                $insert->fname = $request['fname'];
                $insert->lname = $request['lname'];
                $insert->email = $request['email'];
                $insert->password = bcrypt($request['password']);
                $insert->gender = $request['gender'];
                $insert->image =  $fileName ;
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

    public function update(Request $request,$id)
    {     
        $this->validate($request, [
            'status' => 'required',
            'description' => 'required',
        ]);
       
        User::find($id)->update($request->all());
        return redirect()->route('user.index')
                         ->with('success','user blocked successfully');

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
            $this->validate($request, [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required',
                'address' =>'required',
            ]);

            if($file = $request->hasFile('image')) {

                $this->validate($request, [
                    'image'=>'mimes:jpeg|image|png',
                ]);
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName() ;
                $extention = $file->getClientOriginalExtension();
                $destinationPath = public_path().'/upload/' ;
                $file->move($destinationPath,$fileName);
            }

             $update = User::where('id','=',$id)->update( [
                 'fname'=> $request->fname,
                 'lname'=> $request->lname,
                 'email'=>$request->email,
                 'gender' =>$request->gender,
                 'image'=>$fileName,
                 'address'=>$request->address,
             ]);



             return redirect()->route('user.index')
                            ->with('success','user updated successfully');
        }

}   
