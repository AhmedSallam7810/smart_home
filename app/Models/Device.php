<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'user_id' => 'integer',
        'room_id' => 'integer',
        'type_id' => 'integer',
        'status' => 'integer',
        'active' => 'integer'
    ];

    public function room()
    {

        return $this->belongsTo(Room::class);
    }

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function type()
    {

        return $this->belongsTo(Type::class);
    }


    public function usersRooms()
    {
        return $this->belongsToMany(Room::class, 'room_user')
            ->withPivot('user_id', 'created_at', 'updated_at');
    }
}
