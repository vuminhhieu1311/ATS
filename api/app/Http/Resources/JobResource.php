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
            'employmentType' => $this->employment_type,
            'description' => $this->description,
            'requirement' => $this->requirement,
            'benefit' => $this->benefit,
            'minOffer' => $this->min_offer,
            'maxOffer' => $this->max_offer,
            'currency' => $this->currency,
            'deadline' => $this->deadline,
            'photoUrl' => $this->photo_url,
            'status' => $this->status,
            'pipelineId' => $this->pipeline_id,
            'candidates' => CandidateResource::collection($this->whenLoaded('candidates')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'pipeline' => new PipelineResource($this->whenLoaded('pipeline')),
        ];
    }
}
