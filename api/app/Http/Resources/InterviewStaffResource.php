<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;
use Illuminate\Http\Resources\MissingValue;

class InterviewStaffResource extends ShareResource
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
            'interviewId' => $this->interview_id,
            'staffId' => $this->staff_id,
            'score' => $this->score,
            'criterionResults' => CriterionResultResource::collection($this->whenLoaded('criterionResults')),
        ];
    }
}
