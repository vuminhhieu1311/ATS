<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class EducationResource extends ShareResource
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
            'schoolName' => $this->school_name,
            'fieldOfStudy' => $this->field_of_study,
            'degree' => $this->degree,
            'isCurrent' => $this->is_current,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'candidate' => new CandidateResource($this->whenLoaded('candidate')),
        ];
    }
}
