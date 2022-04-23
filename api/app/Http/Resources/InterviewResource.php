<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class InterviewResource extends ShareResource
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
            'startTime' => $this->start_time,
            'endTime' => $this->end_time,
            'note' => $this->note,
            'isOnline' => $this->is_online,
            'link' => $this->link,
            'status' => $this->status,
            'rooms' => RoomResource::collection($this->whenLoaded('rooms')),
            'staffs' => StaffResource::collection($this->whenLoaded('staffs')),
        ];
    }
}
