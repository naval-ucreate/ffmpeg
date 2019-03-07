<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Image;
use  App\Components\FileUpload;
class ScaleImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scale:image';
    var $path  = "";
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To scale image';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = public_path('/images');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Image $image,FileUpload $scale_image)
    {
        $image_data  =  $image->latest()->count();
        if($image_data>0){
            $image_data  =  $image->latest()->first();
            $image_data->scale_image_name  =   $scale_image->createScaledImage($image_data);
            $image_data->save();
            $this->info('image scaled successfully');
            exit;
        }
        $this->info('There is some error');
    }
}
