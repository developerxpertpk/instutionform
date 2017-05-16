<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School_image;
use App\School;
use File;
class ImageController extends Controller
{

    public function index(){
        
    }

    public function  edit($id){
        $schools = School::find($id);
        return view('admin.dashboard.school.upload_images',compact('schools'));
    }

    public function destroy($image_id){
        $image = School_image::find($image_id);
        $school_id=$image->school_id;
        $schoolfolder_path = 'upload/schools/school'.'_'.$school_id.'/images/gallery/';
        $file= $image->image;
        $path = public_path().$schoolfolder_path.$file;
        File::delete($path);
        $image->delete();
        return back();
    }

}
