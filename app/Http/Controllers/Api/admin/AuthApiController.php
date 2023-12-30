<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    // public function register(RegisterRequest $request){
    //     $data=$request->validated();
    //     $data['password']=Hash::make();
    //     $user=User::create($data);
    //     $token=$user->createToken('personal access token')->plainTextToken;

    //     return response()->json([
    //         'status' => true,
    //         'code' => 200,
    //         'data' => $user,
    //         'token' => $token

    //     ]);

    // } 
    
    
    public function login(LoginRequest $request){

        $admin=Admin::where('email',$request->email)->first();

        if(!$admin){
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('auth.email_not_found'),
                'data' => null

            ]);
        }

        if(Hash::check($request->password,$admin->password)){

            $token=$admin->createToken('personal access token')->plainTextToken;
            return response()->json([
                'status' => true,
                'code' => 200,
                'data' => $admin,
                'token' => $token

            ]);
        }
        else{
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('auth.wrong_password'),
                'data' => null

            ]);
        }

    }






}
