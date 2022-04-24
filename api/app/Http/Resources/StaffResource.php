<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class StaffResource extends ShareResource
{
    /**
     * Transform the resource into an array.
     *
     * @var  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request) // @codingStandardsIgnoreLine
    {
        return [
            'id' => $this->id,
            'staffCode' => $this->staff_code,
            'position' => $this->position,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
