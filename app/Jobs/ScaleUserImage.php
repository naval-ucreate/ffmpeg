<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Image;
use  App\Components\S3FileUpload;
class ScaleUserImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Image $image,S3FileUpload $s3fileupload)
    {
        $image_data  =  $image->latest()->count();
        if($image_data>0){
            $image_data  =  $image::latest()->first();
            $image_data->scale_image_name  =   $s3fileupload->createScaledImageInS3($image_data);
            $image_data->save();
            echo "image saved";
            exit;
        }
        echo "image not saved";
    }
}
