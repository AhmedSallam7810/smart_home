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
            'type_id'=>$this->type_id,
            'type_en_name'=>$this->type->en_name,
            'type_ar_name'=>$this->type->ar_name,
            'type_icon'=>url($this->type->icon),
        ];
    }
}
