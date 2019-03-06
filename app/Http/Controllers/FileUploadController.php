<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    var $path  = "";
    public function __construct(){
        $this->path = public_path('/images');
    }
    public function index(){
        return view('fileupload');
    }
     function scaleImage(Array $parms){        
        $input          =   $this->path."/".$parms['name'];
        $output_image   =   time().'_'.$parms['scale_size'].'.'.$parms['extension'];
        $output         =   $this->path."/".$output_image;
        exec('ffmpeg -i '.$input.' -vf scale='.$parms['scale_size'].':-1 '.$output);
        $data['input_image']    =   $parms['name'];
        $data['output_image']   =   $output_image;
        return $data;
    }
    public function fileUpload(Request $request){
       $this->validate($request, [
            'file_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);     
        $image              = $request->file('file_upload');
        $parms['extension'] = $image->getClientOriginalExtension();
        $parms['name']      = time().'.'.$image->getClientOriginalExtension();
        $destinationPath    = $this->path;
        if($image->move($destinationPath, $parms['name']))
        {
            $parms['scale_size']    = $request->input('scale_size');
            $image_data             = $this->scaleImage($parms);
            return back()->with('success','Image Scaled successfully')->with( ['image_data' => $image_data] );
        }
        return back()->with('error','There is some issue!');
    }

}
