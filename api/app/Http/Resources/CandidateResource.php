<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;
use Illuminate\Http\Resources\MissingValue;

class CandidateResource extends ShareResource
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
            'description' => $this->description,
            'resumeUrl' => $this->sume_url,
            'status' => $this->status,
            'currentJob' => $this->current_job ?? new MissingValue(),
            'application' => new CandidateJobResource($this->whenLoaded('application')),
            'experiences' => ExperienceResource::collection($this->whenLoaded('experiences')),
            'education' => EducationResource::collection($this->whenLoaded('education')),
            'socialProfiles' => SocialProfileResource::collection($this->whenLoaded('socialProfiles')),
            'jobs' => JobResource::collection($this->whenLoaded('jobs')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
