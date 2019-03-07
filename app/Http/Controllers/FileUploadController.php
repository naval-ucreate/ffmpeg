<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Requests\ScaleImage;
class FileUploadController extends Controller
{
    var $path  = "";
    public function __construct(){
        $this->path = public_path('/images');
    }
    public function index(){
        return view('fileupload');
    }
    public function fileUpload(ScaleImage $request,Image $image){
        $file               = $request->file('file_upload');
        $parms['name']      = time().'.'.$file->getClientOriginalExtension();
        $destination_path   = $this->path;
        if($file->move($destination_path, $parms['name'])){
            $parms['scale_size']    = $request->input('scale_size');
            $image->create($parms);
            return back()->with('success','Image info saved successfully');
        }
        return back()->with('error','There is some issue!');
    }
}
