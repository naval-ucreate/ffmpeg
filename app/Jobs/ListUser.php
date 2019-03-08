<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;

class ListUser implements ShouldQueue
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
    public function handle(User $user)
    {
        $user_data  =   $user::get()->toArray();
        $file_path  =   public_path('/images');
        $myfile     =   fopen($file_path."/".time(), "w") or die("Unable to open file!");
        fwrite($myfile,json_encode($user_data));
        fclose($myfile);
    }
}
