<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\VerificationEmail;
use App\Models\RoomUser;
use App\Models\User;
use App\Notifications\EmailNotification;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;

class AuthApiController extends Controller
{
    public function register(RegisterRequest $request)
    {

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        event(new Registered($user));

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
            if( !auth()->user()->parent_id){

                foreach( auth()->user()->rooms as $room){

                    foreach($room->devices as $device){
                        $device->delete();
                    }
                    $room->delete();
                }
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

    public function verify_email($user_id, Request $request) {

        if (!$request->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return view('user.successVerification');
    }

    public function forget_password(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
                    ? response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => "reset email sent successfully",

                    ])
                    : response()->json([
                        'status' => true,
                        'code' => 404,
                        'message' => "reset email error",

                    ]);;
    }

    public function show_reset_password_page(Request $request,string $token) {
        return view('user.resetPassword', ['token' => $token,'request' => $request]);
    }



    public function reset_password(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? view('user.successResetPassword')
                    : "error";
    }


}
