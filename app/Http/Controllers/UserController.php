<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validate;


class UserController extends Controller
{
    // controller to retrive the data from database and show data

    	/* function for users */

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required'|'unique',
        //     'password' => 'required',
        // ]);

        User::create($request->all());
        return redirect()->route('user.index')
                        ->with('success','Item created successfully');
    }


	public function show($id){  
		//userShow() is use to show the particular user profile
		$user = User::find($id);	
        return view('admin.dashboard.user.show',compact('user'));
		}


	public function edit($id){  
		//userShow() is use to show the particular user profile
		$user = User::find($id);
        	
        return view('admin.dashboard.user.edit',compact('user'));
		}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {     $this->validate($request, [
            'status' => 'required',
            'description' => 'required',
        ]);
   
       
        User::find($id)->update($request->all());
        return redirect()->route('user.index')
                        ->with('success','user blocked successfully');
    }



	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index')
                        ->with('success',auth()->user()->fname." ".auth()->user()->lname." ".' deleted successfully');
    }

    public function status_update(Request $request,$id){

        if($request['status'] == 0){
        $status = User::Where('id','=',$id)->first();
        $status->status = $request['status'];
        $status->save();

        return redirect()->route('user.index')
                        ->with('success','user unblocked successfully');
        }

        if($request['status'] == 1){
                $status = User::Where('id','=',$id)->first();
                $status->status = $request['status'];
                $status->save();

               return redirect()->route('user.index')
                                ->with('success','user blocked successfully');
                }




      
    }
}
