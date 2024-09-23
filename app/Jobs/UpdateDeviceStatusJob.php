<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateDeviceStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $device;
    protected $status;

    public function __construct($device,$status)
    {
        $this->device=$device;
        $this->status=$status;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       $this->device->update(['status'=>$this->status,'job_id'=>'']);

    }
}
