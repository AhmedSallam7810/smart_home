<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sub_user_room = RoomResource::collection($this->roomsDevices->unique());
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "parent_id" => $this->parent_id,
            "rooms" => $sub_user_room
        ];
    }
}
