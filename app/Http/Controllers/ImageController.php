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

    public function delete_image($image_id,$school_id){
        $image = School_image::find($image_id);
        $schoolfolder_path = 'upload/schools/school'.'_'.$school_id.'/images/gallery/';
        $file= $image->image;
        $path = public_path().$schoolfolder_path.$file;
        File::delete($path);
        $image->delete();
        return redirect()->route('school.show',$school_id);
    }

}
