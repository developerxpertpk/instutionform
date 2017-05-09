<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\School;
use App\location;
use App\Document;
use Carbon\Carbon;
use App\School_rating;
use App\School_image;
use App\School_detail;
use File;
use Response;
use Auth;
class SchoolController extends Controller
{
    // Index Function
    public function index(Request $request)
    {
        $schools = School::orderBy('id', 'desc')->paginate(10);
        return view('admin.dashboard.school.index', compact('schools'))
                             ->with('i');
    }

    // function to create school
    public function create()
    {
        return view('admin.dashboard.school.register_school');
    }

    // function to store data
    public function store(Request $request)
    {
        $rules = array(

            'school_name' => 'required',
            'school_address' => 'required',
            'zip' => 'required|alpha_num|min:4|max:10',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'profile' => 'image',
            'image[]' =>'image',
            'document[]' =>'mime|docx,doc,pdf,txt',
        );

        $validator = Validator::make(Input::all(), $rules);
        // server side validation
        if ($validator->fails()) {
            return redirect()->route('school.create')
                ->withInput()
                ->withErrors($validator);

        } else {
            /*  make model objects */
            $location = new Location();     /*location object*/
            $school = new School();         /* School object */
            $image = new School_image();    /* image object */
            $document = new School_detail();/*document object */

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

            // code for  profile image
            if ($request->hasFile('profile')) {

                $files = $request->file('profile');
                $school_id = $school->id;
                $schoolfolder_path = 'upload/schools/school'.'_'.$school_id.'/images/profile_pic/current_dp';
                $schoolfolder_path_1 = 'upload/schools/school'.'_'.$school_id.'/images/profile_pic';
                $destinationPath = public_path().'/'.$schoolfolder_path;
                $destinationPath_1 = public_path().'/'.$schoolfolder_path_1;

                if (!File::exists($destinationPath)){
                    File::makeDirectory($destinationPath, 0777, true);
                }

                $fileName = $files->getClientOriginalName();
                $extention = $files->getClientOriginalExtension();
                $files->move($destinationPath,$fileName);
                $image_path = $destinationPath.'/'.$fileName;
                $image_path = $destinationPath.'/'.$fileName;

                //  copy image in profile pic folder
                $copy = File::copy($destinationPath.'/'.$fileName,$destinationPath_1.'/'.$fileName);

                $image->school_id = $school_id;
                $image->image = $fileName;
                $image->image_type=1;
                $image->save();
            }

            // code for upload images if any
            if ($request->hasFile('image')) {

                $files = $request->file('image');
                // Making counting of uploaded images
                $file_count = count($files);
                // start count how many uploaded
                $uploadcount = 0;
                $school_id = $school->id;
                $schoolfolder_path = 'upload/schools/school'.'_'. $school_id;
                $destinationPath = public_path().'/'.$schoolfolder_path;

                if (File::exists($destinationPath)) {
                    $dataSet = [];
                    $now = Carbon::now();
                    foreach ($files as $file) {
                        $fileName = $file->getClientOriginalName();
                        $extention = $file->getClientOriginalExtension();
                        $file->move($destinationPath.'/images/gallery/',$fileName);
                        $timestamp = $now->getTimestamp();
                        $image_path = $destinationPath.'/images/gallery' . '/' . $fileName;
                        $dataSet[] = [
                            'image' => $fileName,
                            'image_type'=>0,
                            'school_id' => $school_id,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                        $uploadcount++;
                    }
                    DB::table('school_images')->insert($dataSet);
                } else {
                    File::MakeDirectory($destinationPath, 0777, true);
                    $dataSet = [];
                    $now = Carbon::now();
                    foreach ($files as $file) {
                        $fileName = $file->getClientOriginalName();
                        $extention = $file->getClientOriginalExtension();
                        $file->move($destinationPath . '/images/gallery/', $fileName);
                        $timestamp = $now->getTimestamp();
                        $image_path = $destinationPath . '/images/gallery' . '/' . $fileName;

                        $dataSet[] = [
                            'image' => $fileName,
                            'image_type'=>0,
                            'school_id' => $school_id,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                        $uploadcount++;
                    }
                    DB::table('school_images')->insert($dataSet);
                }
            }

            //code for documents
            if($request->hasFile('document')){
                $documents = $request->file('document');
                // Making counting of uploaded images
                $file_count = count($documents);
                // start count how many uploaded
                $uploadcount = 0;
                $school_id = $school->id;
                $schoolfolder_path = 'upload/schools/school'.'_'. $school_id;
                $destinationPath = public_path() .'/'. $schoolfolder_path;

                if (File::exists($destinationPath)){
                    $dataSet = [];
                    $now = Carbon::now();
                    foreach ($documents as $file) {
                        $fileName = $file->getClientOriginalName();
                        $extention = $file->getClientOriginalExtension();
                        $file->move($destinationPath .'/documents/', $fileName);
                        $timestamp = $now->getTimestamp();
                        $file_path = $schoolfolder_path .'/documents/'.$fileName;

                        $dataSet[] = [
                            'school_id' => $school_id,
                            'documents' => $fileName,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];

                        $uploadcount++;
                    }
                    DB::table('school_details')->insert($dataSet);
                }else{
                    File::MakeDirectory($destinationPath, 0777, true);
                    $dataSet = [];
                    $now = Carbon::now();
                    foreach ($documents as $file) {
                        $fileName = $file->getClientOriginalName();
                        $extention = $file->getClientOriginalExtension();
                        $file->move($destinationPath . '/documents/', $fileName);
                        $timestamp = $now->getTimestamp();
                        $file_path = $schoolfolder_path . '/documents/' . $fileName;
                        $dataSet[] = [
                            'school_id' => $school_id,
                            'documents' => $fileName,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];

                        $uploadcount++;
                    }
                    DB::table('school_details')->insert($dataSet);
                } // end of else condition
            } //end of document if

            return redirect()->route('school.index')
                ->with('success', 'school Registerd successfully !!!!');

        }
    } //end of  store method

    // function to delete data
    public function destroy($id)
    {
        //function to destroy datd
        $school = School::find($id);
        $school->school_images()->delete();
        $school->delete();
        $school->locations()->delete();
        $school->school_details()->delete();
        return redirect()->route('school.index')
            ->with('success', 'Deleted successfully');
    }

    // function to edit data
    public function edit($id)
    {
        // get data from databse
        $school = School::find($id);
        $gallery_images = School_image::where([
        ['school_id','=',$school->id],
        ['image_type','=',0],
        ])->get();
        $gallery_profile = School_image::where([
            ['school_id','=',$school->id],
            ['image_type','=',1],
        ])->get();
        $documents = School_detail::where([
           [ 'school_id','=',$school->id],
        ])->get();

        return view('admin.dashboard.school.edit', compact('school','gallery_profile','gallery_images','documents'));
    }

    public function school_update1(Request $request, $id)
    {
        $rules = array(
            'school_name' => 'required',
            'school_address' => 'required',
            'zip' => 'required|alpha_num|min:4|max:10',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'profile' => 'image|max:20000',
            'image[]' =>'image|max:20000',
            'document[]' =>'mime|docx,doc,pdf,txt,jpg,png',
        );

        $validator = Validator::make(Input::all(), $rules);
        // server side validation
        if ($validator->fails()) {
            return redirect()->route('school.edit',$id)
                                ->withInput()
                                ->withErrors($validator);

        } else {
            $loc_id = School::find($id)->location_id;
            location::find($loc_id)->update($request->all());
            School::find($id)->update($request->all());

            // code to update the Profile pic

            if($request->hasfile('profile')){
                $files = $request->file('profile');
                $image_profile  = School_image::where([
                    ['school_id','=',$id],
                    ['image_type','=',1]
                ])->first();

                // if not image is uploaded
                $schoolfolder_path = 'upload/schools/school'.'_'.$id.'/images/profile_pic/current_dp';
                $schoolfolder_path_1 = 'upload/schools/school'.'_'.$id.'/images/profile_pic';
                $destinationPath = public_path().'/'.$schoolfolder_path;
                $destinationPath_1 = public_path().'/'.$schoolfolder_path_1;
                // code get image data
                $fileName = $files->getClientOriginalName();
                $image_path = $destinationPath.'/'.$fileName;

                //if there is an data from database
                if(count($image_profile)){

                    File::delete('upload/schools/school_'.$id.'/images/profile_pic/current_dp/'.$image_profile->image);
                    $files->move($destinationPath,$fileName);
                    $copy = File::copy($destinationPath.'/'.$fileName,$destinationPath_1.'/'.$fileName);
                    $result = School_image::where('id','=',$image_profile->id )
                                        ->update(['image' => $fileName]);
                    }else{

                    if(!File::exists($destinationPath)){
                        File::makeDirectory($destinationPath, 0777, true);
                    }

                    $files->move($destinationPath,$fileName);
                    $copy = File::copy($destinationPath.'/'.$fileName,$destinationPath_1.'/'.$fileName);

                    //query to insert imgae in table
                    $image = new School_image();
                    $image->image = $fileName;
                    $image->image_type = 1;
                    $image->school_id = $id;
                    $image->save();
                }
            }
            return redirect()->route('school.index')
                ->with('success', 'school updated successfully');
        }

    }


    // function to block/unblock school
    public function status_update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $school = School::find($id)->update($request->all());

        return redirect()->route('school.index')
            ->with('success', 'School updated successfully');

    }


    public function show($id)
    {
        $schools = School::find($id);
        $profile_image = School_image::where( [
            ['school_id','=',$schools->id],
            ['image_type','=',1]
        ] )->orderby('id')->get();
        $gallery_images = School_image::where( [
            ['school_id','=',$schools->id],
            ['image_type','=',0]
        ] )->orderby('id')->get();
        $documents = School_detail::where('school_id','=',$schools->id)->orderby('id')->get();
        return view('admin.dashboard.school.school_show', compact('schools' ,'profile_image','gallery_images', 'documents'));
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
}





