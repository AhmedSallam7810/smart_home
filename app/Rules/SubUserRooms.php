<?php

namespace App\Rules;

use App\Models\RoomUser;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SubUserRooms implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $super_user_rooms=RoomUser::where('user_id',auth()->user()->id)->pluck('room_id')->toArray();
        $sub_user_rooms=array_map('intval',$value);
        $isSubset = empty(array_diff($sub_user_rooms, $super_user_rooms));
        if(!$isSubset){
            $fail('rooms don\'t belong to super user');
        }

    }
}
