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
use App\Models\Room;

class DeviceController extends Controller
{
    use ImageUploader;
    use ApiResponse;


    public function index($room_id){
        $room=Room::where('id',$room_id)->first();

        if (!$room) {
            return $this->apiResponse404('', "room not found");
        }

        if($room->user_id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

        }

        $devices=$room->devices;
        $data = DeviceResource::collection($devices);
        return $this->apiResponse($data,"return data successfully");
    }

    public function getAllDevices()
    {
        $devices=Device::where('user_id',auth()->user()->id)->get();
        $data = DeviceResource::collection($devices);
        return $this->apiResponse($data,"return data successfully");
    }



    public function store(Request $request, $room_id)
    {
        $room=Room::where('id',$room_id)->first();

        if (!$room) {
            return $this->apiResponse404('', "room not found");
        }

        if($room->user_id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

        }

        $data['name']=$request->name;
        $data['room_id']=$room_id;
        $data['type_id']=$request->type_id;
        $data['user_id']=auth('user')->user()->id;
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

        if($device->user_id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

        }

        $data = DeviceResource::make($device);
        return $this->apiResponse($data,"return data successfully");



    }



    public function update(Request $request, $device_id)
    {

        $device = Device::where('id',$device_id)->first();

        if(!$device){
            return $this->apiResponse404('',"Device not found");
        }

        if($device->user_id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

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

        if($device->user_id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

        }

        $device->delete();
        $data = DeviceResource::make($device);
        return $this->apiResponse($data,"deleted data successfully");

   }
}
