<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class ResumeResource extends ShareResource
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
            'uuid' => $this->uuid,
            'content' => $this->content,
            'candidate' => new CandidateResource($this->whenLoaded('candidate')),
        ];
    }
}
