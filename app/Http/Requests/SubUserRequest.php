<?php

namespace App\Http\Requests;

use App\Models\RoomUser;
use App\Rules\SubUserRooms;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() == 'POST') {
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
                'parent_id' => ['required', 'exists:users,id'],
                'rooms' => ['required', 'array']
            ];
        } elseif ($this->method() == 'PUT') {
            return [
                'name' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'email', Rule::unique('users')->ignore($this->route('sub_user')), 'max:255'],
                'password' => ['nullable', 'string', 'min:6'],
                'rooms' => ['nullable', 'array']
            ];
        }
    }
}
