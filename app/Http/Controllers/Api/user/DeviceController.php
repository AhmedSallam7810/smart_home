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

class DeviceController extends Controller
{
    use ImageUploader;
    use ApiResponse;


    public function index(){
        $devices=Device::where('user_id',auth()->user()->id)->get();
        $data = DeviceResource::collection($devices);
        return $this->apiResponse($data,"return data successfully");
    }

    public function allByRoom($room_id)
    {
        $devices=Device::where('user_id',auth()->user()->id)
                        ->where('room_id',$room_id)->get();
        $data = DeviceResource::collection($devices);
        return $this->apiResponse($data,"return data successfully");
    }

    
    
    public function store(DeviceRequest $request)
    {
        $data=$request->validated();
        
        $data['user_id']=auth()->user()->id;
        
        $Device=Device::create($data);

        $data = DeviceResource::make($Device);
        
        return $this->apiResponse($data,"stored data successfully");
    }

    
    
    public function show($id)
    {
        $device = Device::where('user_id',auth()->user()->id)
                        ->where('id',$id)->first();
        if(!$device){
            return $this->apiResponse('',"Device not found"); 
        }
        
        $data = DeviceResource::make($device);
        return $this->apiResponse($data,"return data successfully");
        


    }

 
    
    public function update(DeviceRequest $request, $id)
    {

        $device = Device::find($id);
        if(!$device){
            return $this->apiResponse('',"Device not found"); 
        }

        $data=$request->validated();

        $device->update($data);

        $data = DeviceResource::make($device);
        return $this->apiResponse($data,"updated data successfully");


    }

   
    
    public function destroy($id)
    {
        $device = Device::find($id);
        if(!$device){
            return $this->apiResponse('',"Device not found"); 
        }
        
        $device->delete();
        $data = DeviceResource::make($device);
        return $this->apiResponse($data,"deleted data successfully");
        
   }
}