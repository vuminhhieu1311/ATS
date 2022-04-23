<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class SocialProfileResource extends ShareResource
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
            'url' => $this->url,
            'candidate' => new CandidateResource($this->whenLoaded('candidate')),
        ];
    }
}
