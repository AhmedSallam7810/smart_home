<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\DeviceRequest;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\ImageUploader;
use App\Jobs\UpdateDeviceStatusJob;
use App\Models\Room;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class DeviceController extends Controller
{
    use ImageUploader;
    use ApiResponse;


    public function index($room_id){
        $room=Room::where('id',$room_id)->first();

        if (!$room) {
            return $this->apiResponse404('', "room not found");
        }

        if( !$room->users->contains(auth()->user())){
            return $this->apiResponse404('', "not have permissions");
        }
        $devices=$room->devices;
        $data = DeviceResource::collection($devices);
        return $this->apiResponse($data,"return data successfully");
    }

    public function getAllDevices()
    {
        // $devices=Device::where('user_id',auth()->user()->id)->get();
        // $data = DeviceResource::collection($devices);
        return $this->apiResponse([],"return data successfully");
    }



    public function store(Request $request, $room_id)
    {
        $room=Room::where('id',$room_id)->first();

        if (!$room) {
            return $this->apiResponse404('', "room not found");
        }

        if($room->users[0]->id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

        }

        $data['name']=$request->name;
        $data['room_id']=$room_id;
        $data['type_id']=$request->type_id;
        // $data['user_id']=auth('user')->user()->id;
        if($request->status){
            $data['status']=intval($request->status);
        }
        else{
            $data['status']=0;
        }

        $Device=Device::create($data);

        $data = DeviceResource::make($Device);

        return $this->apiResponse($data,"stored data successfully");
    }



    public function show($device_id)
    {


        $device = Device::where('id',$device_id)->first();

        if(!$device){
            return $this->apiResponse404('',"Device not found");
        }

        if( !$device->room->users->contains(auth()->user())){
            return $this->apiResponse404('', "not have permissions");
        }

        $data = DeviceResource::make($device);
        return $this->apiResponse($data,"return data successfully");



    }


//certain user device
    public function update(Request $request, $device_id)
    {

        $device = Device::where('id',$device_id)->first();

        if(!$device){
            return $this->apiResponse404('',"Device not found");
        }

        if(!$request->has('status')){
            if($device->room->users[0]->id!=auth('user')->user()->id){

                return $this->apiResponse404('', "not have permissions");

            }
        }


        $data=$request->all();

        if($request->has('status')){
            $data['status']=intval($request->status);
        }


        $device->update($data);

        $data = DeviceResource::make($device);
        return $this->apiResponse($data,"updated data successfully");


    }



    public function destroy($device_id)
    {
        $device = Device::where('id',$device_id)->first();

        if(!$device){
            return $this->apiResponse404('',"Device not found");
        }


        if($device->room->users[0]->id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

        }

        $device->update(['active'=>0]);
        $data = DeviceResource::make($device);
        return $this->apiResponse($data,"inactive device successfully");

   }


   public function setTimer(Request $request,$device_id)
   {


       $device = Device::where('id',$device_id)->first();

       if(!$device){
           return $this->apiResponse404('',"Device not found");
       }

       if( !$device->room->users->contains(auth()->user())){
           return $this->apiResponse404('', "not have permissions");
       }

        $job = new UpdateDeviceStatusJob($device,$request['status']);
        $job->delay(now()->addMinutes(intval($request['minutes'])));
        $jobId = app(Dispatcher::class)->dispatch($job);
        $device->update(['job_id'=>$jobId]);
    //    $job=UpdateDeviceStatusJob::dispatch($device,$request['status'])->delay(now()->addMinutes(intval($request['minutes'])))->getJobId();

       return $this->apiResponse([],'Timer work on '.$request['minutes'].' minutes');



   }

   public function destroyTimer($device_id)
   {
    $job_id=Device::where('id',$device_id)->pluck('job_id')[0];

    if(!$job_id){
        return $this->apiResponse404('',"no timer on this device");
    }
    DB::table('jobs')->where('id', $job_id)->delete();
    DB::table('devices')->where('id', $device_id)->update(['job_id'=>null]);
    return $this->apiResponse([],'timer deleted successfully!');
   }


}

