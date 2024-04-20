<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TypeRequest extends FormRequest
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
                'en_name'=>['required'],
                'ar_name'=>['required'],
                'image'=>['file'],
                'show_in_app'=>''
            ];
        }
        elseif($this->method()==='PUT'){
            return [
                'en_name'=>['required'],
                'ar_name'=>['required'],
                'image'=>['file'],
                'show_in_app'=>''

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
