<?php

namespace App\Jobs;

use Aimeos\Admin\JQAdm\Common\Decorator\Page;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Filesystem\Cache;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;

class PutFilesToMinioJob implements ShouldQueue
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
    public function handle()
    {
        $files = DB::table('mshop_media')->whereDate('mtime', Carbon::yesterday()->toDateString())->pluck('link');

        $basicPath = public_path() . '/';
        foreach ($files as $file) {

            if(file_exists($basicPath . $file) && $file != ""){
                Storage::disk('minio')->put('test', new File($basicPath . $file));
            }
        }


    }
}
