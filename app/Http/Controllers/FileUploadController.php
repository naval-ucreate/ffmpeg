<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Requests\ScaleImage;
use Illuminate\Support\Facades\Storage;
use App\Components\S3FileUpload;
class FileUploadController extends Controller
{
    var $path  = "";
    public function __construct()
    {
        $this->path = public_path('/images'); 
    }
    public function index(){
        return view('fileupload');
    }
    public function fileUpload(ScaleImage $request,Image $image,S3FileUpload $s3fileupload){
        if ($request->hasFile('file_upload')) {
            $file           = $request->file('file_upload');
            $name           = time().'.'.$file->getClientOriginalExtension();
            $s3fileupload->uploadInS3($name,$file);           
            $parms['scale_size']    = $request->input('scale_size');
            $parms['name']          = $name;
            $image->create($parms);
            return back()->with('success','Image uploaded successfully');
        }
        return back()->with('error','There is some issue!');
    }
}
