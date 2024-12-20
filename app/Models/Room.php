<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'user_id' => 'integer',
        'type_id' => 'integer',
    ];

    public function devices()
    {

        return $this->hasMany(Device::class);
    }

    // public function users(){

    //     return $this->belongsToMany(User::class,'room_user');
    // }


    public function usersDevices()
    {
        return $this->belongsToMany(User::class, 'room_user')
            ->withPivot('device_id', 'created_at', 'updated_at');
    }

    public function type()
    {

        return $this->belongsTo(Type::class);
    }
}
