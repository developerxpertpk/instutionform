<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School_image;
use App\School_detail;
use App\School;
use File;
class ImageController extends Controller
{

    public function index(){

    }
//    public function edit($id){
//        $schools = School::find($id);
//        return view('admin.dashboard.school.upload_images',compact('schools'));
//    }

    public function delete_image($image_id){
        $image = School_image::where('id',$image_id)->first();
        $school_id=$image->school_id;
        $file= $image->image;

        if($image->image_type == 0){
            $schoolfolder_path = 'upload/schools/school'.'_'.$school_id.'/images/gallery/';
            $path = public_path().$schoolfolder_path.$file;
            File::delete($path);
        }else{
            $schoolfolder_path = 'upload/schools/school'.'_'.$school_id.'/images/profile_pic/current_dp';
            $schoolfolder_path1 = 'upload/schools/school'.'_'.$school_id.'/images/profile_pic';
            $path = public_path().$schoolfolder_path.$file;
            $path1 = public_path().$schoolfolder_path1.$file;
            File::delete($path);
            File::delete($path1);
        }
        $image->delete();
        return back();
    }
    // function for detete document
    public function delete_document($document_id){
        $document = School_detail::find($document_id);
        $school_id=$document->school_id;
        $file= $document->document;
        $schoolfolder_path = 'upload/schools/school_'.$school_id.'/documents/';
        $path = public_path().$schoolfolder_path.$file;
        File::delete($path);
        $document->delete();
        return back();
    }

}
