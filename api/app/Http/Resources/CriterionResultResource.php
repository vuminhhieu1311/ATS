<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;
use Illuminate\Http\Resources\MissingValue;

class CriterionResultResource extends ShareResource
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
            'interviewStaffId' => $this->interview_staff_id,
            'criterionId' => $this->criterion_id,
            'score' => $this->score,
            'note' => $this->note,
        ];
    }
}
