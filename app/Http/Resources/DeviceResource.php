<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name" => $this->name,
            "status" => $this->status,
            "id" => $this->id,
            'user_id'=>$this->user_id,
            'room_id'=>$this->room_id,
            'type_id'=>$this->type_id,
            'type_en_name'=>$this->type->en_name,
            'type_ar_name'=>$this->type->ar_name,
            'type_icon'=>$this->type->icon,
        ];
    }
}
