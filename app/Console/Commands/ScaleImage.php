<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use  App\Jobs\ScaleUserImage;
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
    public function handle(ScaleUserImage $scale_user_image)
    {
        $scale_user_image->dispatch();
    }
}
