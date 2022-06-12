<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;
use Illuminate\Http\Resources\MissingValue;

class InterviewResource extends ShareResource
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
            'startTime' => $this->start_time,
            'endTime' => $this->end_time,
            'note' => $this->note,
            'isOnline' => $this->is_online,
            'link' => $this->link,
            'status' => $this->status,
            'score' => $this->score,
            'candidateJobId' => $this->candidate_job_id,
            'mailTemplateId' => $this->mail_template_id,
            'mailTitle' => $this->mail_title,
            'mailContent' => $this->mail_content,
            'roomId' => $this->room_id,
            'room' => new RoomResource($this->whenLoaded('room')),
            'candidateJob' => new CandidateJobResource($this->whenLoaded('candidateJob')),
            'interviewers' => StaffResource::collection($this->whenLoaded('interviewers')),
            'assessmentForm' => new AssessmentFormResource($this->whenLoaded('assessmentForm')),
            'interviewStaffs' => InterviewStaffResource::collection($this->whenLoaded('interviewStaffs')),
            'scheduler' => new StaffResource($this->whenLoaded('scheduler')),
        ];
    }
}
