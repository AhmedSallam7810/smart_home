<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data=[
            'id'=>$this->id,
            'en_name'=>$this->en_name,
            'ar_name'=>$this->ar_name,
        ];

        if($this->category==1){
            $data['image']=url($this->image_path);
        }
        else{
            $data['icon']=$this->icon;

        }

        return $data;
    }
}
