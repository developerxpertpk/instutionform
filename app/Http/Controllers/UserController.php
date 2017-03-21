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

    public function store(Request $request){

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
            //return redirect()->route('show.login');
        

    
        // $this->validate($request, [
        //     'email' => 'required'|'unique',
        //     'password' => 'required',
        // ]);

      
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



public function search(Request $request)
{

  //  print_r($request);
     
    // Gets the query string from our form submission 
    $query = Request::Input('search');
    print_r($query);
    die('a');
    // Returns an array of articles that have the query string located somewhere within 
    // our articles titles. Paginates them so we can break up lots of search results.
    $articles = DB::table('articles')->where('title', 'LIKE', '%' . $query . '%')->paginate(10);
        
    // returns a view and passes the view the list of articles and the original query.
    return view('page.search', compact('articles', 'query'));
 
 }
    
}
