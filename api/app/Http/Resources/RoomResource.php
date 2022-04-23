<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class RoomResource extends ShareResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     * @var  \Illuminate\Http\Request $request
     *
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'interviews' => InterviewResource::collection($this->whenLoaded('interviews')),
        ];
    }
}
