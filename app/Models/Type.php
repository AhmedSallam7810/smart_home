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

            return 'uploads/types/'.($this->image?$this->image:"default.png");
        }
        return 'uploads/types/'.($this->image?$this->image:"device_default.png");
    }

    public function rooms(){

        return $this->hasMany(Room::class);
    }

}
