<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class RejectionResource extends ShareResource
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
            'reason' => $this->reason,
        ];
    }
}
