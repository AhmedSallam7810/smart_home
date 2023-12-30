<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function getImagePathAttribute(){
        return 'uploads/types/'.$this->image;
    }
    
    public function rooms(){

        return $this->hasMany(Room::class);
    }

}
