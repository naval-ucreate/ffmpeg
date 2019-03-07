<?php
namespace App\Components;
class FileUpload
{
    public function __construct(){
        $this->path = public_path('/images');
    }
    private function getExtension($imageUrl){
        $info       =   pathinfo($imageUrl);
        $extension  =   $info['extension'];
        return $extension;
    }

    private function scaleImage(array $parms){
        exec('ffmpeg -i '.$parms['input'].' -vf scale='.$parms['scale_size'].':-1 '.$parms['output']);
        return true;
    }

    public function createScaledImage($image_data){
        $parms['input']         =   $this->path."/".$image_data->name;
        $parms['scale_size']    =   $image_data->scale_size;
        $extension              =   $this->getExtension($parms['input']);
        $output_image           =   time().'_'.$parms['scale_size'].".".$extension;
        $parms['output']        =   $this->path."/".$output_image;
        $this->scaleImage($parms);
        return true;
    }

}
