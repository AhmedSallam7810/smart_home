<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Helpers\ImageUploader;
use App\Http\Resources\DeviceESPResource;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class ESPController extends Controller
{
    use ImageUploader;
    use ApiResponse;


    public function changeDeviceStatus(Request $request, $user_id, $room_id)
    {
        $user=User::find($user_id);
        if(!$user){
            return response()->json([
            'error'=>'user not found'
            ],404);
        }
        $room=Room::find($room_id);
        if(!$room){
            return response()->json([
            'error'=>'room not found'
            ],404);
        }

        if( $room->user_id!=$user_id){
            return response()->json([
            'error'=>'has no permissions'
            ],403);
        }


        $rdata = $request->all();
        $device = Device::where('room_id', $room_id)->where('id', $rdata['device_id'])->first();
        $device->update(['status' => $rdata['status']]);
        $devices = Device::where('room_id', $room_id)->get();
        $data = DeviceESPResource::collection($devices);
        return response()->json(['data' => $data]);
    }

    public function changeDeviceAllStatus(Request $request, $user_id, $room_id)
    {

        $user=User::find($user_id);
        if(!$user){
            return response()->json([
            'error'=>'user not found'
            ],404);
        }

        $rdata = $request->all();

        foreach ($rdata['devices'] as $row) {
            $device = Device::where('room_id', $room_id)->where('id', $row['device_id'])->first();
            $device->update(['status' => $row['status']]);
        }
        $devices = Device::where('room_id', $room_id)->get();
        $data = DeviceESPResource::collection($devices);
        return response()->json(['data' => $data]);
    }

    public function getAllDeviceInRoom($user_id, $room_id)
    {
        $user=User::find($user_id);
        if(!$user){
            return response()->json([
            'error'=>'user not found'
            ],404);
        }
        $room=Room::find($room_id);
        if(!$room){
            return response()->json([
            'error'=>'room not found'
            ],404);
        }

        if( $room->user_id!=$user_id){
            return response()->json([
            'error'=>'has no permissions'
            ],403);
        }

        $devices = Device::where('room_id', $room_id)->get();
        $data = DeviceESPResource::collection($devices);
        return response()->json(['data' => $data]);
    }

}
