<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $token = $user->createToken('personal access token')->plainTextToken;

        return response()->json([
            'status' => true,
            'code' => 200,
            'data' => $user,
            'token' => $token

        ]);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('auth.email_not_found'),
                'data' => null

            ],400);
        }

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('personal access token')->plainTextToken;
            return response()->json([
                'status' => true,
                'code' => 200,
                'data' => $user,
                'token' => $token

            ]);
        } else {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => __('auth.wrong_password'),
                'data' => null

            ]);
        }
    }

    function deleteAccount(){


        DB::beginTransaction();

        try {
            foreach( auth()->user()->rooms as $room){

                foreach($room->devices as $device){
                    $device->delete();
                }
                $room->delete();
            }
            auth()->user()->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => "account deleted successfully",

            ]);


        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => $e->getMessage(),

            ],400);
        }

    }

}
