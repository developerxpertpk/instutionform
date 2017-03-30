<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\School;
use App\School_image;
use App\location;
use App\Document;
use Carbon\Carbon;
use File;


class SchoolController extends Controller
{
//
      public function index(Request $request){
            $schools =School::orderBy('id','desc')->get();
            return view('admin.dashboard.school.index',compact('schools'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
      }

      public function create(){

            return view('admin.dashboard.school.register_school');
      }

      public function destroy($id)
      {
                   //function to destroy datd
                     $school = School::find($id);
                    // $location_id = School::find($id)->location_id;

                     $school->locations()->delete();
                     $school->school_images()->delete();
                     $school->documents()->delete();
                     $school->delete();

                     return redirect()->route('school.index')
                                       ->with('success','Deleted successfully');
       }

       public function edit($id){
           
            // get data from databse
           $school = School::find($id);
            return view('admin.dashboard.school.edit',compact('school'));

       }

    
      public function store(Request $request){

                  $rules = array(
                     'school_name' => 'required',
                     'school_address' => 'required',
                     'country' => 'required',
                     'state' =>   'required',
                     'city' => 'required'
                  );

             $validator = Validator::make(Input::all(), $rules);
                         
                  // server side validation
                  if($validator->fails()){

                  return redirect()->to('school.create')
                                    ->withErrors($validator)
                                    ->withInput();
                                  
                  }else{
                     
                     /*  make model objects */
                      $location= new Location();  /*location object*/
                      $school= new School();     /* School object */
                      $image= new School_image(); /* image object */
                      $document= new Document(); /*document object */   
                             // check weather request has image path or not
                       $location->country = $request['country'];
                       $location->state = $request['state'];
                       $location->city = $request['city'];
                                                   
                       $location->save();
                        
                        $school->location_id=$location->id;
                        $school->school_name=$request['school_name'];
                        $school->school_address=$request['school_address'];
                        $school->save(); 

            
               // code for upload images if any 
               if($request->hasFile('image')){
                          
                          
                          
                   
                    $rules = [];
                    $files = count($request->file('image')) - 1;

                  //  echo "<pre>"; 

                    foreach(range(0, $files) as $index) {

                    $rules['files.' . $index] = 'image|mimes:png,jpeg,jpg,gif';
                    //print_r($rules);
                    }

                    $validator = Validator::make($request->all() , $rules);
                    
                    if ($validator->fails()) {

                     return response()->json(array(
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                    ) , 400);

                     // return redirect()->route('school.create');
                     //                    withErrors($validator);
                    }
                    
                        $files=$request->file('image');
                      
                          // Making counting of uploaded images
                        $file_count = count($files);
                          // start count how many uploaded
                        $uploadcount = 0;

                        $school_id=$school->id;
                        $schoolfolder = str_replace (" ", "_", $school->school_name);
                        $schoolfolder_path='upload'.'/schools/'.$schoolfolder.$school_id;
                        $destinationPath = public_path().'/'.$schoolfolder_path;

                        File::MakeDirectory($destinationPath,0777,true);
                         
                         $dataSet = [];
                         $now = Carbon::now();

                        foreach($files as $file) {
                              $fileName = $file->getClientOriginalName();
                              $extention = $file->getClientOriginalExtension();
                              $file->move($destinationPath,$fileName);

                              $timestamp = $now->getTimestamp();
                              $image_path=$schoolfolder_path.'/'.$fileName;

                              $dataSet[] = [
                                   'image' => $image_path,
                                   'school_id'  => $school_id,
                                   'created_at' => $now,
                                   'updated_at' => $now,
                                 ];
                              $uploadcount++;
                               
                        }  

                      DB::table('school_images')->insert($dataSet);

                      if($uploadcount == $file_count ){     
                     return redirect()->route('school.index')
                                       ->with('success','school Registerd successfully !!!!');
                     }else{
                        die('a');
                     }  
                  }       

            // code to upload files 
        if($request->hasFile('document')){
                  
                  $documents = $request->file('document');
                     // Making counting of uploaded images
                    $file_count = count($documents);
                     // start count how many uploaded
                    $uploadcount = 0;
                    $school_id=$school->id;
                    $schoolfolder = str_replace (" ", "_", $school->school_name);
                    $schoolfolder_path='upload'.'/documents/'.$schoolfolder.$school_id;
                    $destinationPath = public_path().'/'.$schoolfolder_path;

                     File::MakeDirectory($destinationPath,0777,true);
                      
                     $dataSet = [];
                     $now = Carbon::now();
                   
                        foreach($documents as $file) {
                                     
                                    $fileName = $file->getClientOriginalName();
                                    $extention = $file->getClientOriginalExtension();
                                    //$filesize=$file->getSize();
                                    $file->move($destinationPath,$fileName);
                                    $timestamp = $now->getTimestamp();

                                    $file_path=$schoolfolder_path.'/'.$fileName;
                                    
                                    $dataSet[] = [                               
                                         'school_id'  => $school_id,
                                         'document' => $file_path,
                                         'created_at' => $now,
                                         'updated_at' => $now,
                                    ];
                                 $uploadcount++;      

                            } 
                     DB::table('documents')->insert($dataSet);

                    if($uploadcount==$file_count){
                       return redirect()->route('school.index')
                           ->with('success','school Registerd successfully !!!!');
           
                        }else{
                            return redirect()->route('school.create')
                           ->withError('Document is not uploaded');
  
                        }
                
                    
            } 

           return redirect()->route('school.index')
            ->with('success','school Registerd successfully !!!!');
            }
      }
   }
     
     // $schools =School::find(2)->location_id;

      //$schools=schools()->locations->id;

      //$location=Location::find(2)->country;

      // $schools =School::orderby('id','asc')->get();
      //     foreach($schools as $key => $school){
      //       print_r($school->locations) ;
      //     }

    
  

   