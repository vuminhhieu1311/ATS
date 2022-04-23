<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class ExperienceResource extends ShareResource
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
            'companyName' => $this->company_name,
            'position' => $this->position,
            'summary' => $this->summary,
            'isCurrent' => $this->is_current,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'candidate' => new CandidateResource($this->whenLoaded('candidate')),
        ];
    }
}
