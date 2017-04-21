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
use App\School_rating;
use File;
use Response;
use Auth;


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

        $school->school_images()->delete();
        $school->delete();
        $school->locations()->delete();
        // $school->documents()->delete();

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


        /*echo "<pre>";
        // print_r($request->file('image'));

        $rules=array(
                // 'image' => 'image|mimes:png,jpeg,jpg,gif',
                'image' => 'required',
            );

        // $validator=new \stdClass();
        // $i=0;
        $count=count($request->file('image'));

        // print_r($request->file('image'));
        // print_r($request->all()['image']);
        $temp=array(
            'image' => array(),
            );

        // die();
        // $temp['image'];

        for($i=0;$i<$count;$i++){

            $temp['image'][]=$request->file('image')[$i];

            $validator = Validator::make($temp, $rules);
            if ($validator->fails()) {
                //echo "error <br/>";

                print_r($validator->messages()->getMessages());

            }else{
                reset($temp['image']);
                echo "success <br>";
            }
        }

        // print_r($temp);
        die();

        for($i=0;$i<$count;$i++){
            $validator->$i = Validator::make($request->file('image')[$i], $rules);
        }
        die();
        foreach($request->file('image') as $file){
            $validator->$i = Validator::make($file, $rules);
            $i++;
        }
            


        die();*/

        $rules = array(
            'school_name' => 'required',
            'school_address' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            /*'image' => 'image|mimes:png,jpeg,jpg,gif',*/
            'document' => 'mimes:pdf,docx,doc|max:500',
        );
        $validator = Validator::make(Input::all(), $rules);
        // server side validation
        if ($validator->fails()) {
            return redirect()->route('school.create')
                ->withErrors($validator)
                ->withInput();
        } else {
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
            $location->save();


            $school->location_id = $location->id;
            $school->school_name = $request['school_name'];
            $school->school_address = $request['school_address'];
            $school->save();


            // code for upload images if any
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

                if ($uploadcount == $file_count) {
                    return redirect()->route('school.index')
                        ->with('success', 'school Registerd successfully !!!!');
                } else {
                    die('a');
                }
            }

            // code to upload documents
            if ($request->hasFile('document')) {
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
        // if serach bar is not empty
        if (!empty($search)) {

            if (!empty($search)) {

                $schools = School::where('school_name', 'LIKE', '%' . $search . '%')
                    ->orderBy('school_name')
                    ->get();

                if (!$schools->isEmpty()) {

                    return view('admin.dashboard.school.search')
                        ->with('schools', $schools)
                        ->with('i', ($request->input('page', 1) - 1) * 5);
                } else {

                    $locations = Location::where('city', 'LIKE', '%' . $search . '%')
                        ->orWhere('state', 'LIKE', '%' . $search . '%')
                        ->orWhere('country', 'LIKE', '%' . $search . '%')
                        ->orderBy('country')
                        ->get();
                }

                if (!$locations->isEmpty()) {

                    return view('admin.dashboard.school.search')
                        ->with('locations', $locations)
                        ->with('i', ($request->input('page', 1) - 1) * 5);


                } else {

                    return view('admin.dashboard.default')
                        ->withError('404 ERROR ');
                }
            } else {
                return redirect()->route('school.index')
                    ->withError('Please Enter Name/state/country to find School');
            }
        }

    }

    // function to block/unblock school
    public function status_update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        // echo"<pre>";
        //$school =School::find($id)->id;
        $school = School::find($id)->update($request->all());

        return redirect()->route('school.index')
            ->with('success', 'School updated successfully');

    }

    public function school_update(Request $request, $id)
    {
        $loc_id = School::find($id)->location_id;
        location::find($loc_id)->update($request->all());
        School::find($id)->update($request->all());
        // code for upload images if any
        if ($request->hasFile('image')) {
            $files = $request->file('image');

            // Making counting of uploaded images
            $file_count = count($files);
            // start count how many uploaded
            $uploadcount = 0;

            $school_id = School::find($id)->id;
            $schoolfolder = str_replace(" ", "_", $school->school_name);
            $schoolfolder_path = 'upload' . '/schools/' . $schoolfolder . $school_id;
            $destinationPath = public_path() . '/' . $schoolfolder_path;

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

            if ($uploadcount == $file_count) {
                return redirect()->route('school.index')
                    ->with('success', 'school Registerd successfully !!!!');
            } else {
                die('a');
            }
        }

        // code to upload documents
        if ($request->hasFile('document')) {
            $documents = $request->file('document');
            // Making counting of uploaded images
            $file_count = count($documents);
            // start count how many uploaded
            $uploadcount = 0;
            $school_id = School::find($id)->id;
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
            ->with('success', 'school updated successfully');

    }

    public function show($id)
    {
        $schools = School::find($id);
        return view('admin.dashboard.school.school_show', compact('schools'));
    }

    public function check_ratings(Request $request){

        $school_id= $request->school_id;
        $school_user = School_rating::where([
            ['user_id', '=', Auth::user()->id],
            ['school_id', '=', $school_id],
        ])->exists();

        if($school_user == true){

            $ratings = School_rating::select('ratings')->where([
                ['school_id','=',$school_id],
                ['user_id','=',Auth::user()->id]
            ])->first();
            return response($ratings);

        }else{
            return response()->json(false);
        }


    }

    public function school_rating(Request $request)
    {

        $school_id = $request->school_id;
        $rate = $request->rating;

        $school_user = School_rating::where([
            ['user_id', '=', Auth::user()->id],
            ['school_id', '=', $school_id],
        ])->exists();

        if ($school_user == true)
         {
             $already_rated = School_rating::select('ratings')->where([
                  ['school_id','=',$school_id],
                  ['user_id','=',Auth::user()->id]
                 ])->first();
            return response()->json($already_rated);

        } else {
        $rating = new School_rating;
        $rating->school_id = $school_id;
        $rating->user_id = Auth::user()->id;
        $rating->ratings = $rate;
        $rating->save();
        return response()->json($rate);
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

    
  

   