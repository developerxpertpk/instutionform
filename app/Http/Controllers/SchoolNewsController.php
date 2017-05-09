<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\School_news;
use  App\School;
use App\Location;
use Illuminate\Validation;
use Validator;
use Response;

class SchoolNewsController extends Controller
{
    // index() function
    public function index(Request $request)
    {
        $news = School_news::orderby('id', 'desc')->paginate(5);
        return view('admin.dashboard.school_news.index', compact('news'))
                        ->with('i');
    }

    // create() is used to create a news
    public function create()
    {
        return view('admin.dashboard.school_news.add_news');
    }

    public function show(Request $request ,$id){
        $school_news = School_news::find($id);
        return view('admin.dashboard.school_news.show',compact('school_news'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'school_name' => 'required ',
            'school_id'=>'required',
            'news_title' => 'required ',
            'news_description' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
                        return redirect()->route('school_news.create')
                                        ->withErrors($validator);

           } else{

                $school_id = $request['school_id'];
                $school_id = School::find($school_id);
                // Make Object of School_news model
                $news = new School_news();
                $news->school_id = $school_id->id;
                $news->news_title = $request['news_title'];
                $news->news_description = $request['news_description'];
                $news->save();

                return redirect()->route('school_news.index')
                                ->with('success','News uploaded successfully');

            }
        }

    //funtion to destroy a news
    public function destroy($id)
    {
        School_news::find($id)->delete();
        return redirect()->route('school_news.index')
            ->with('success', 'Data Deleted successfully');
    }

    public function search_school()
    {
        $term = Input::get('term');
        $data = DB::table('schools')->where('school_name','LIKE',$term.'%')->get()->toArray();
        $return_array = array();
        $i = 0;
        foreach ($data as $school_data) {

            $return_array[$i]['value'] = $school_data->id;
            $return_array[$i]['label'] = $school_data->school_name;
            $return_array[$i]['id'] = "hello1234";
            $i++;
        }
       // print_r($return_array);
        echo json_encode($return_array);
    }

    public function edit($id)
    {
        $school_news = School_news::find($id);
        return view('admin.dashboard.school_news.edit', compact('school_news'));
    }

    // function to update news
    public function update_news(Request $request,$id){
        $rules = array(
            'news_title' => 'required ',
            'news_description' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {

            return redirect()->route('school_news.edit', $id)
                ->withErrors($validator);

        } else {

            $result = School_news::find($id)->update($request->all());
            return redirect()->route('school_news.index')
                            ->with('success','News Updated Successfully');
        }
    }

    public function filter_school(Request $request){
        $search = $request->input('search');
        // if serach bar is not empty
            if(!empty($search)) {
                $schools = School::where('school_name', 'LIKE', '%' . $search . '%')
                            ->orderBy('school_name')
                            ->get();
                if (!$schools->isEmpty()){
                    return view('admin.dashboard.school_news.search')
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
                    return view('admin.dashboard.school_news.search')
                                ->with('locations', $locations)
                                ->with('i', ($request->input('page', 1) - 1) * 5);


                } else {

                    return view('admin.dashboard.default')
                            ->withError('404 ERROR ');
                }
            } else {
                return redirect()->route('school_news.index')
                                ->withError('Please Enter Name/state/country to find School');
            }

        }


    public function news_list($id){
                $school_data = School::find($id);
                $news_result = School_news::where('school_id','=',$id)->get();
                return view('admin.dashboard.school_news.news_list',compact('news_result','school_data'))
                           ->with('i');
        }

        // function to upadte news Status
    public function update_status(Request $request,$id){

        $this->validate($request, [
            'status' => 'required',
        ]);
        School_news::find($id)->update($request->all());

        return redirect()->route('school_news.index')
                         ->with('success', ' News updated successfully');

    }

}
