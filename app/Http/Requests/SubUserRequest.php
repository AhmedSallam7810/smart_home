<?php

namespace App\Http\Requests;

use App\Models\RoomUser;
use App\Rules\SubUserRooms;
use Illuminate\Foundation\Http\FormRequest;

class SubUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        if($this->method()=='POST'){
            return [
                'name'=>['required','string','max:255'],
                'email'=>['required','email','unique:users,email','max:255'],
                'password'=>['required','string','min:6'],
                'parent_id'=>['required','exists:users,id'],
                'rooms'=>['required','array', new SubUserRooms]
            ];
        }
        elseif($this->method()=='PUT'){
            return [
                'name'=>['nullable','string','max:255'],
                'email'=>['nullable','email','unique:users,email','max:255'],
                'password'=>['nullable','string','min:6'],
                'parent_id'=>['nullable','exists:users,id'],
                'rooms'=>['nullable','array', new SubUserRooms]
            ];
        }


    }
}
