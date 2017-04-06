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
    // Index Function
    public function index(Request $request)
    {
        $schools = School::orderBy('id', 'desc')->get();
        return view('admin.dashboard.school.index', compact('schools'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    // function to create school
    public function create()
    {
        return view('admin.dashboard.school.register_school');
    }

    // function to delete data
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
            ->with('success', 'Deleted successfully');
    }

    // function to edit data
    public function edit($id)
    {
        // get data from databse
        $school = School::find($id);
        return view('admin.dashboard.school.edit', compact('school'));
    }

    // function to store data
    public function store(Request $request)
    {
        $rules = array(
            'school_name' => 'required',
            'school_address' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'image'=>'image|mimes:png,jpeg,jpg,gif',
            'document'=>'mimes:pdf,docx,doc|max:500',
        );
        $validator = Validator::make(Input::all(), $rules);
        // server side validation
        if ($validator->fails()) {
            return redirect()->route('school.create')
                            ->withErrors($validator)
                            ->withInput();
        }else{
                /*  make model objects */
            $location = new Location();     /*location object*/
            $school = new School();         /* School object */
            $image = new School_image();    /* image object */
            $document = new Document();     /*document object */

            /*store data into locations table */
            $location->country = $request['country'];
            $location->state = $request['state'];
            $location->city = $request['city'];
            $location->zip = $request['zip'];
            $location->latitude = $request['latitude'];
            $location->longitude = $request['longitude'];

            /* using save() to save data */
            $location->save();

            /* store data into Schools table */
            $school->location_id = $location->id;
            $school->school_name = $request['school_name'];
            $school->school_address = $request['school_address'];

            /* using save() to save data */
            $school->save();

            // code for upload images if any

            if($request->hasFile('profile_pic'))
            {

                $rules =array('profile_pic' => 'image');
                $validator = Validator::make(Input::all(), $rules);

                if($validator->fails()) {
                    return redirect()->route('school.create')
                        ->withErrors($validator)
                        ->withInput();
                }else{

                    $file = $request->file('profile_pic');


                    $fileName = $file->getClientOriginalName();
                    $extention = $file->getClientOriginalExtension();

                    $school_id = $school->id;
                    $schoolfolder = str_replace(" ", "_", $school->school_name);
                    $schoolfolder_path = 'upload'.'/'.'schools/' . $schoolfolder . $school_id;
                    $dp_folder_path='upload'.'/schools/'.$schoolfolder.$school_id.'/dp';
                    $dp_temp_folder='upload'.'/schools/'.$schoolfolder . $school_id.'/dp/temp';

//                    $destinationPath = public_path().'/'.$schoolfolder_path;
//                    File::MakeDirectory($destinationPath, 0777, true);


//                    $destinationPath = public_path().'/'.$dp_folder_path;
//                    File::MakeDirectory($destinationPath, 0777, true);
//                    $file->move($destinationPath, $fileName);
//
//                    $destinationPath = public_path().'/'.$dp_temp_folder;
//                    File::MakeDirectory($destinationPath, 0777, true);
//                    $file->move($destinationPath, $fileName);
//
//
//                    $image_path = $dp_temp_folder.'/'.$fileName;
//
//                    $image->image =$image_path;
//                    $image->school_id =$school_id;
//                    $image->save();
//
//                    $image_path =$dp_folder_path.'/'.$fileName;
//                    $image->image =$image_path;
//                    $image->school_id =$school_id;
//                    $image->save();
                }

            }

            // code to upload image
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                // Making counting of uploaded images
                $file_count = count($files);
                // start count how many uploaded
                $uploadcount = 0;

                $school_id = $school->id;
                $schoolfolder = str_replace(" ", "_", $school->school_name);
                $schoolfolder_path = 'upload' . '/schools/' . $schoolfolder . $school_id;
                $destinationPath = public_path() . '/' . $schoolfolder_path;
                // make directory
                File::MakeDirectory($destinationPath, 0777, true);

                $dataSet = [];
                $now = Carbon::now();

                foreach ($files as $file) {
                    $fileName = $file->getClientOriginalName();
                    $extention = $file->getClientOriginalExtension();
                    $file->move($destinationPath, $fileName);

                    $timestamp = $now->getTimestamp();
                    $image_path = $schoolfolder_path . '/' . $fileName;

                    $dataSet[] = [
                        'image' => $image_path,
                        'school_id' => $school_id,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                    $uploadcount++;
                }
                DB::table('school_images')->insert($dataSet);

                if($uploadcount == $file_count) {
                    return redirect()->route('school.index')
                        ->with('success', 'school Registerd successfully !!!!');
                } else {
                    die('a');
                }
            }

            // code to upload documents
            if($request->hasFile('document')) {
                $documents = $request->file('document');
                // Making counting of uploaded images
                $file_count = count($documents);
                // start count how many uploaded
                $uploadcount = 0;
                $school_id = $school->id;
                $schoolfolder = str_replace(" ", "_", $school->school_name);
                $schoolfolder_path = 'upload' . '/documents/' . $schoolfolder . $school_id;
                $destinationPath = public_path() . '/' . $schoolfolder_path;

                File::MakeDirectory($destinationPath, 0777, true);

                $dataSet = [];
                $now = Carbon::now();

                foreach ($documents as $file) {

                    $fileName = $file->getClientOriginalName();
                    $extention = $file->getClientOriginalExtension();
                    //$filesize=$file->getSize();
                    $file->move($destinationPath, $fileName);
                    $timestamp = $now->getTimestamp();

                    $file_path = $schoolfolder_path . '/' . $fileName;

                    $dataSet[] = [
                        'school_id' => $school_id,
                        'document' => $file_path,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                    $uploadcount++;
                }
                DB::table('documents')->insert($dataSet);

                if ($uploadcount == $file_count) {
                    return redirect()->route('school.index')
                        ->with('success', 'school Registerd successfully !!!!');

                } else {
                    return redirect()->route('school.create')
                        ->withError('Document is not uploaded');

                }
            }

            return redirect()->route('school.index')
                ->with('success', 'school Registerd successfully !!!!');
        }
    }

    // function to add search functionality
    static function search(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)){

            $schools = School::where('school_name', 'LIKE', '%' . $search . '%')
                                ->orderBy('school_name')
                                ->get();

            if (!$schools->isEmpty()){

                return view('admin.dashboard.school.search')
                        ->with('schools',$schools)
                        ->with('i', ($request->input('page', 1) - 1) * 5);
            }else {

            $locations = Location::where('city', 'LIKE', '%' . $search . '%')
                    ->orWhere('state', 'LIKE', '%' . $search . '%')
                    ->orWhere('country', 'LIKE', '%' . $search . '%')
                    ->orderBy('country')
                    ->get();
            }

                if(!$locations->isEmpty()){

                    return view('admin.dashboard.school.search')
                                    ->with('locations', $locations)
                                    ->with('i', ($request->input('page', 1) - 1) * 5);


                } else {

                    return view('admin.dashboard.default')
                                     ->withError('404 ERROR ');
                }
        }else {
                return redirect()->route('school.index')
                                 ->withError('Please Enter Name/state/country to find School');
        }
    }

    // function to block/unblock school
    public function status_update(Request $request,$id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        // echo"<pre>";
        //$school =School::find($id)->id;
        $school = School::find($id)->update($request->all());

        return redirect()->route('school.index')
                        ->with('success','School updated successfully');

    }


}

     // $schools =School::find(2)->location_id;

      //$schools=schools()->locations->id;

      //$location=Location::find(2)->country;

      // $schools =School::orderby('id','asc')->get();
      //     foreach($schools as $key => $school){
      //       print_r($school->locations) ;
      //     }

    
  

   