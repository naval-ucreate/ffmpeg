<?php
namespace App\Components;
use Illuminate\Support\Facades\Storage;
use App;
class S3FileUpload
{
    var $path   =   "";
    var $s3_folder   =   "";
    public function __construct(){
        $this->path = public_path('/images'); 
        $this->s3_folder = env('S3_FOLDER');
    }
    private function scaleImage(array $parms){
        exec('ffmpeg -i '.$parms['input'].' -vf scale='.$parms['scale_size'].':-1 '.$parms['output'] ." 2>&1" , $out);
        // dd($out);
        return true;
    }
    private function getExtension($imageUrl){
        $info       =   pathinfo($imageUrl);
        $extension  =   $info['extension'];
        return $extension;
    }
    private function createTempDir(){
        if(!is_dir($this->path))
        {
            mkdir($this->path,0777,true);           
        }
    }
    public function uploadInS3($name,$file){
        Storage::disk('s3')->put($this->s3_folder."/".$name, file_get_contents($file),'public');
    }
    public function createScaledImageInS3($image_data){
        $img_name               =   $image_data->name;
        $parms['input']         =   Storage::url($this->s3_folder."/".$img_name);
        $parms['scale_size']    =   $image_data->scale_size;
        if (App::environment(['production'])) {
           $this->createTempDir();
        }
        $extension              =   $this->getExtension($parms['input']);
        $output_image           =   time().'_'.$parms['scale_size'].".".$extension;
        $parms['output']        =   $this->path."/".$output_image;
        $this->scaleImage($parms);       
        $this->uploadInS3($output_image,$parms['output']);
        return $output_image;
    }

}