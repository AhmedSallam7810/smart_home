<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\SubUserRequest;
use App\Http\Resources\SubUserResource;
use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubUserController extends Controller
{
   use ApiResponse;

    public function index(){
        $users=User::with('rooms')->where('parent_id',auth()->user()->id)->get();
        $sub_users=SubUserResource::collection($users);
        return $this->apiResponse($sub_users,"subsusers retrieve successfully!!");
    }

    public function show($id){

        $user=User::with('rooms')->where('id',$id)->first();

        if($user->parent_id!=auth()->user()->id){
            return $this->apiResponse404('', "has no permissions");
        }
        
        $subUser=SubUserResource::make($user);
        return $this->apiResponse($subUser,'sub-user retrieve successfully!!');

    }


    public function store(SubUserRequest $request){

       $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->rooms()->attach($data['rooms']);
        // foreach($data['rooms'] as $room_id){
        //    RoomUser::create([
        //     'user_id'=>$user->id,
        //     'room_id'=>$room_id
        //    ]);
        // }
        $newUser=SubUserResource::make($user);
        return $this->apiResponse($newUser,'sub-user created successfully!!');

    }

    public function update(SubUserRequest $request, $id){

        $user=User::with('rooms')->where('id',$id)->first();

        if($user->parent_id!=auth()->user()->id){
            return $this->apiResponse404('', "has no permissions");
        }

        $data=$request->except('rooms');
        $user->update($data);

        if($request['rooms']){
            $user->rooms()->sync($request['rooms']);
        }

        $updatedUser=SubUserResource::make($user);

        return $this->apiResponse($updatedUser,'sub-user updated successfully!!');
    }

    public function destroy($id){

        $user=User::with('rooms')->where('id',$id)->first();

        if($user->parent_id!=auth()->user()->id){
            return $this->apiResponse404('', "has no permissions");
        }
        // $user->rooms()->detach(); not need that
        $user->delete();
        return $this->apiResponse($user,'sub-user deleted successfully!!');

    }
}
