<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class JobResource extends ShareResource
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
            'country' => $this->country,
            'city' => $this->city,
            'employment_type' => $this->employment_type,
            'description' => $this->description,
            'requirement' => $this->requirement,
            'benefit' => $this->benefit,
            'minOffer' => $this->min_offer,
            'maxOffer' => $this->max_offer,
            'currency' => $this->currency,
            'deadline' => $this->deadline,
            'status' => $this->status,
            'candidates' => CandidateResource::collection($this->whenLoaded('candidates')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'pipeline' => new PipelineResource($this->whenLoaded('pipeline')),
        ];
    }
}
