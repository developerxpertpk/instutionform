<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\School_news;
use Illuminate\Validation;
use Validator;
use  App\School;
use Response;


class School_newsController extends Controller
{
    // index() function
    public function index(Request $request){
        $news = School_news::orderby('id','desc')->paginate(5);;
        return view('admin.dashboard.school_news.index',compact('news'))
                    ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    // create() is used to create a news
    public function create(){
        return view('admin.dashboard.school_news.add_news');
    }

    public function store(Request $request)
    {

   $rules = array(
            'school_name' => 'required ',
            'news_title' => 'required ',
            'news_description' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {

            return redirect()->route('school_news.create')
                            ->withErrors($validator);

        }else {

        $school_name = $request['school_name'];
        $school = DB::table('schools')->where('school_name', '=', $school_name)->get();
        // print_r($school[0]->id);

        if (!empty($school)) {
            // Make Object of School_news model
            $news = new School_news();
            $news->school_id = $school[0]->id;
            $news->news_title = $request['news_title'];
            $news->news_description = $request['news_description'];
            $news->save();

            return redirect()->route('school_news.index')
                                 ->with('success', 'News updated successfully' );
        }else {
            die('a');
            return redirect()->route('school_news.create')
                                ->with('Input')
                                ->withError('Sorry School DoesNot Exist');
                        }

      }
    }

    //funtion to destroy a news
    public function destroy($id)
    {
        School_news::find($id)->delete();
        return redirect()->route('school_news.index')
                        ->with('success','Data Deleted successfully');
    }

    public function search_school()
    {

        $term = Input::get('term');
        $data = DB::table('schools')->where('school_name', 'LIKE', '%' . $term . '%')->get();

                $return_array = [];
                foreach ($data as $school_data) {
                    $return_array['id'] = $school_data->school_name;
                    $return_array['label'] = $school_data->school_name;
                    $return_array['value'] = $school_data->school_name;

                }
                return Response::json($return_array);

    }


    public function show(){
        die('a');
    }

}
