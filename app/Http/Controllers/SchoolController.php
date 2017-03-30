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
              //echo "<pre>";
                     print_r(School::find($id));
                     print_r(School::locations()->id);
                       die('a');
                       return redirect()->route('school.index')
                                       ->with('success','Data Deleted successfully');
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
                        
                        $files=$request->file('image');
                      
                          // Making counting of uploaded images
                        $file_count = count($files);
                          // start count how many uploaded
                        $uploadcount = 0;

                              $rules=array(
                                 'image' => 'image|mimes:png,jpeg,jpg,gif');
                              $messages = [
                                'image.image' => 'file must be an image',
                                'image.mimes' => 'file must be jpeg'
                              ];

                              $bnt = count($files) - 1;

                              foreach(range(0, $bnt) as $index) {
                                 $rules['image.' . $index] = 'image|mimes:png,jpeg,jpg,gif|max:3000';
                              
                              }


                        $validate =Validator::make($files ,$rules ,$messages);

                        if($validate->fails()){

                              return redirect()->route('school.create')
                                        ->withErrors($validate)
                                        ->withInput();

                        }else{

                       

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
                  }        
                  if($uploadcount == $file_count ){     
                     return redirect()->route('school.index')
                                       ->with('success','school Registerd successfully !!!!');
                     }else{
                        die('a');
                     }         
                           
          }else{
                  die('b');
          } //end of if 
         

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