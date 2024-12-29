<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\SubUserRequest;
use App\Http\Resources\SubUserResource;
use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SubUserController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $users = User::with('roomsDevices')->where('parent_id', auth()->user()->id)->get();
        $sub_users = SubUserResource::collection($users);
        return $this->apiResponse($sub_users, "subsusers retrieve successfully!!");
    }

    public function show($id)
    {

        $user = User::with('rooms')->where('id', $id)->first();

        if ($user->parent_id != auth()->user()->id) {
            return $this->apiResponse404('', "has no permissions");
        }

        $subUser = SubUserResource::make($user);
        return $this->apiResponse($subUser, 'sub-user retrieve successfully!!');
    }


    public function store(SubUserRequest $request)
    {

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $pivotData = [];
        foreach ($data['rooms'] as $room) {
            foreach ($room['devices'] as $device_id) {

                $device_obj = DB::table('room_user')->select('device_id')
                    ->where('user_id', auth()->user()->id)->where('room_id', $room['room_id'])
                    ->where('device_id', $device_id)->get();

                if ($device_obj && count($device_obj) > 0) {

                    $pivotData[] = [
                        'room_id' => $room['room_id'],
                        'device_id' => $device_id,
                    ];
                }
            }
        }

        $user->roomsDevices()->sync($pivotData);


        $newUser = SubUserResource::make($user);
        return $this->apiResponse($newUser, 'sub-user created successfully!!');
    }

    public function update(SubUserRequest $request, $id)
    {

        $user = User::where('id', $id)->first();

        if (!$user || $user->parent_id != auth()->user()->id) {
            return $this->apiResponse404('', "Not Found");
        }

        $data = $request->except('rooms');
        $user->update($data);

        if ($request['rooms']) {

            $pivotData = [];
            foreach ($request['rooms'] as $room) {
                foreach ($room['devices'] as $device_id) {

                    $device_obj = DB::table('room_user')->select('device_id')
                        ->where('user_id', auth()->user()->id)->where('room_id', $room['room_id'])
                        ->where('device_id', $device_id)->get();

                    if ($device_obj && count($device_obj) > 0) {

                        $pivotData[] = [
                            'room_id' => $room['room_id'],
                            'device_id' => $device_id,
                        ];
                    }
                }
            }

            $user->roomsDevices()->sync($pivotData);
        }

        $updatedUser = SubUserResource::make($user);

        return $this->apiResponse($updatedUser, 'sub-user updated successfully!!');
    }



    public function destroy($id)
    {

        $user = User::where('id', $id)->first();

        if ($user->parent_id != auth()->user()->id) {
            return $this->apiResponse404('', "has no permissions");
        }
        // $user->roomsDevices()->detach(); not need that
        $user->delete();
        return $this->apiResponse($user, 'sub-user deleted successfully!!');
    }
}
