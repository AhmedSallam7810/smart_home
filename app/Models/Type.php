<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function getImagePathAttribute(){
        if($this->category==1){

            return 'uploads/types/'.($this->image?$this->image:"default.jpg");
        }
        return 'uploads/types/'.($this->image?$this->image:"device_default.jpg");
    }

    public function rooms(){

        return $this->hasMany(Room::class);
    }
    
    public function devices(){

        return $this->hasMany(Room::class);
    }

}
