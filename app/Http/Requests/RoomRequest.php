<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RoomRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {


        if($this->method()==='POST'){
            return [
                'name'=>['required'],
                'type_id'=>['required'],
            ];
        }
        elseif($this->method()==='PUT'){
            return [
                'name'=>'nullable',
                'type_id'=>'nullable',
            ];
        }

    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'   => $validator->errors(),
            'data'      => ''
        ]));
    }
}
