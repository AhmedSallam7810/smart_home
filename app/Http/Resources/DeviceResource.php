<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $job=DB::table('jobs')->where('id', $this->job_id)->first();

        if($job){
            $created_datetime = Carbon::createFromTimestamp($job->created_at);
            $available_datetime = Carbon::createFromTimestamp($job->available_at);
            $timer_created_at=$created_datetime->toDateTimeString();
            $timer_available_at=$available_datetime->toDateTimeString();
        }


        return [
            "id" => $this->id,
            "name" => $this->name,
            "status" => $this->status,
            "active" => $this->active,
            "set_timer"=>$this->job_id?1:0,
            "timer_created_at"=>isset( $timer_created_at)? $timer_created_at:null,
            "timer_available_at"=>isset( $timer_available_at)? $timer_available_at:null,
            'user_id'=>auth()->user()->id,
            'room_id'=>$this->room_id,
            'type_id'=>$this->type_id,
            'type_en_name'=>$this->type->en_name,
            'type_ar_name'=>$this->type->ar_name,
            'type_icon'=>$this->type->icon,
        ];
    }
}
