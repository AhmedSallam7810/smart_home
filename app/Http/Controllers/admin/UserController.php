<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Requests\userRequest;
use App\Http\Resources\userResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\imageUploader;
use App\Models\Admin;
use App\Models\Type;

class UserController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $users=User::simplePaginate(10);

        return view('Admin.users.index',compact('users'));
    }



//     public function show($id)
//     {
//         $user = user::find($id);
//         if(!$user){
//             return $this->apiResponse('',"user not found");
//         }

//         $data = userResource::make($user);
//         return $this->apiResponse($data,"return data successfully");



//     }
//     public function create()
//     {

//         $users=user::all();

//         return view('Admin.users.create',compact('users'));


//     }



//     public function store(userRequest $request)
//     {
//         $data=$request->validated();

//         $image=$request->file('image');
//         if($image){
//             $image_name=$this->storeimage($image,'users');
//             $data['image']=$image_name;
//         }
//         else{
//             $data['image']='default.png';
//         }
//         $user=user::create($data);

//         $data = userResource::make($user);

//         return $this->apiResponse($data,"stored data successfully");
//     }


//     public function edit($id)
//     {

//         $user=user::find($id);

//         return view('Admin.users.edit',compact('user'));


//     }



//     public function update(userRequest $request, $id)
//     {

//         $user = user::find($id);
//         if(!$user){
//             return $this->apiResponse('',"user not found");
//         }

//         $updated_data=$request->validated();

//         $image=$request->file('image');

//         if($image){
//             $image_name=$this->updateimage($image,'users',$user->image);
//             $updated_data['image']=$image_name;
//         }


//         $user->update($updated_data);

//         $data = userResource::make($user);
//         return $this->apiResponse($data,"updated data successfully");


//     }



//     public function destroy($id)
//     {
//         $user = user::find($id);
//         if(!$user){
//             return $this->apiResponse('',"user not found");
//         }

//         if($user->image!='default.png'){
//             $this->deleteimage($user->image,'users');
//         }

//         $user->delete();
//         $data = userResource::make($user);
//         return $this->apiResponse($data,"deleted data successfully");

//    }
}
