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

    public function __construct($device)
    {
        $this->device=$device;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->device->status){

            $this->device->update(['status'=>0]);
        }
        else{
            $this->device->update(['status'=>1]);
        }
    }
}
