<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\RoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Device;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\ImageUploader;

class RoomController extends Controller
{
    use ImageUploader;
    use ApiResponse;

    public function index()
    {
        $rooms = Room::where('user_id', auth()->user()->id)->get();
        $data = RoomResource::collection($rooms);
        return $this->apiResponse($data, "return data successfully");
    }


    public function store(RoomRequest $request)
    {
        $data = $request->validated();

        $data["user_id"] = auth()->user()->id;
        $room = Room::create($data);
        // create room device

        for ($i = 1; $i <= 6; $i++) {
            $device_data['user_id'] = auth()->user()->id;
            $device_data['room_id'] = $room->id;
            $device_data['name'] = "Switch " . $i;
            $Device = Device::create($device_data);
        }

        $data = RoomResource::make($room);

        return $this->apiResponse($data, "stored data successfully");
    }


    public function show($id)
    {
        $Room = Room::where('user_id', auth()->user()->id)
            ->where('id', $id)->first();
        if (!$Room) {
            return $this->apiResponse('', "Room not found");
        }

        $data = RoomResource::make($Room);
        return $this->apiResponse($data, "return data successfully");


    }


    public function update(RoomRequest $request, $id)
    {

        $Room = Room::find($id);
        if (!$Room) {
            return $this->apiResponse('', "Room not found");
        }

        $updated_data = $request->validated();

        $icon = $request->file('icon');

        if ($icon) {
            $icon_name = $this->updateImage($icon, 'rooms', $Room->icon);
            $updated_data['icon'] = $icon_name;
        }


        $Room->update($updated_data);

        $data = RoomResource::make($Room);
        return $this->apiResponse($data, "updated data successfully");


    }


    public function destroy($id)
    {
        $Room = Room::find($id);
        if (!$Room) {
            return $this->apiResponse('', "Room not found");
        }

        if ($Room->icon != 'default.png') {
            $this->deleteImage($Room->icon, 'rooms');
        }

        $Room->delete();
        $data = RoomResource::make($Room);
        return $this->apiResponse($data, "deleted data successfully");

    }
}
