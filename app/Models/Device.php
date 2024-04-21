<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
        'user_id' => 'integer',
        'room_id' => 'integer',
        'type_id' => 'integer',
        'status' => 'integer',
    ];

    public function room(){

        return $this->belongsTo(Room::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function type(){

        return $this->belongsTo(Type::class);
    }
}
