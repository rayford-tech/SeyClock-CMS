<?php

namespace App\Jobs;

use App\Models\Clockin;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessImageUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $photo;
    public $clockid;

    public function __construct($photo, $clockid)
    {
        $this->photo = $photo;
        $this->clockid = $clockid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clock = Clockin::findOrFail($this->clockid);
        $path = Storage::disk('do')->put('rayfordFord/clockins', $this->photo, 'public');
        $clock->photo = $path;
        $clock->save();
    }
}
