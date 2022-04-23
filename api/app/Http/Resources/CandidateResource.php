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
            'name' => $this->name,
            'email' => $this->email,
            'phoneNumber' => $this->phone_number,
            'address' => $this->address,
            'description' => $this->description,
            'profilePhotoUrl' => $this->profile_photo_url,
            'resumeUrl' => $this->sume_url,
            'status' => $this->status,
            'experiences' => ExperienceResource::collection($this->whenLoaded('experiences')),
            'education' => EducationResource::collection($this->whenLoaded('education')),
            'socialProfiles' => SocialProfileResource::collection($this->whenLoaded('socialProfiles')),
            'jobs' => JobResource::collection($this->whenLoaded('jobs')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
