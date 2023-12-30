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
                'name'=>['required'],
                'image'=>['required','file'],
            ];
        }
        elseif($this->method()==='PUT'){
            return [
                'name'=>'',
                'image'=>'file',
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
