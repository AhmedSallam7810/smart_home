<?php

namespace App\Http\Controllers\Api\user;

use App\Events\ChangeDeviceStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Device;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\ImageUploader;
use App\Models\RoomUser;
use App\Models\User;

class RoomController extends Controller
{
    use ImageUploader;
    use ApiResponse;

    public function index()
    {
        $rooms = User::find(auth()->user()->id)->rooms;
        $data = RoomResource::collection($rooms);
        return $this->apiResponse($data, "return data successfully");
    }

//need to protect from child users
    public function store(RoomRequest $request)
    {
        $data = $request->validated();

        if(auth('user')->user()->parent_id){
            return $this->apiResponse404('', "not have permissions");
        }

        $room = Room::create($data);

        RoomUser::create(['room_id'=>$room->id,'user_id'=>auth()->user()->id]);
        // create room device

        // for ($i = 1; $i <= 6; $i++) {
        //     $device_data['user_id'] = auth()->user()->id;
        //     $device_data['room_id'] = $room->id;
        //     $device_data['name'] = "Switch " . $i;
        //     $Device = Device::create($device_data);
        // }

        $data = RoomResource::make($room);

        return $this->apiResponse($data, "stored data successfully");
    }


    public function show($id)
    {
        $room = Room::find($id);
        if (!$room) {
            return $this->apiResponse404('', "room not found");
        }
        if( !$room->users->contains(auth()->user())){
            return $this->apiResponse404('', "not have permissions");
        }

        $data = RoomResource::make($room);
        return $this->apiResponse($data, "return data successfully");


    }


    public function update(RoomRequest $request, $id)
    {

        $room = Room::find($id);
        if (!$room) {
            return $this->apiResponse404('', "room not found");
        }


        if($room->users[0]->id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

        }

        $updated_data = $request->validated();



        $room->update($updated_data);

        $data = RoomResource::make($room);
        return $this->apiResponse($data, "updated data successfully");


    }


    public function config(Request $request, $id)
    {

        $room = Room::find($id);
        if (!$room) {
            return $this->apiResponse404('', "room not found");
        }

        if($room->users[0]->id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

        }

        // $updated_data = $request->validated();

        // $icon = $request->file('icon');

        // if ($icon) {
        //     $icon_name = $this->updateImage($icon, 'rooms', $room->icon);
        //     $updated_data['icon'] = $icon_name;
        // }


        $room->update(['config'=>true]);

        $data = RoomResource::make($room);
        return $this->apiResponse($data, "updated data successfully");


    }


    public function destroy($id)
    {
        $room = Room::find($id);
        if (!$room) {
            return $this->apiResponse404('', "room not found");
        }

        if($room->users[0]->id!=auth('user')->user()->id){

            return $this->apiResponse404('', "not have permissions");

        }

        if ($room->icon != 'default.png') {
            $this->deleteImage($room->icon, 'rooms');
        }

        $room->delete();
        $data = RoomResource::make($room);
        return $this->apiResponse($data, "deleted data successfully");

    }
}
