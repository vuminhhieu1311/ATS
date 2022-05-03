<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;
use Illuminate\Http\Resources\MissingValue;

class CandidateJobResource extends ShareResource
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
            'candidateId' => $this->candidate_id,
            'jobId' => $this->job_id,
            'stageId' => $this->stage_id,
            'rejectionId' => $this->rejection_id,
            'job' => new JobResource($this->whenLoaded('job')),
        ];
    }
}
