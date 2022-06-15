<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Facades\Log;

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
            'resumeUrl' => $this->resume_url,
            'status' => $this->status,
            'updatedAt' => $this->updated_at,
            'isStar' => $this->is_star,
            'currentJob' => $this->current_job ?? new MissingValue(),
            'finalScore' => $this->finalScore(),
            'application' => new CandidateJobResource($this->whenLoaded('application')),
            'experiences' => ExperienceResource::collection($this->whenLoaded('experiences')),
            'education' => EducationResource::collection($this->whenLoaded('education')),
            'socialProfiles' => SocialProfileResource::collection($this->whenLoaded('socialProfiles')),
            'resumes' => ResumeResource::collection($this->whenLoaded('resumes')),
            'jobs' => JobResource::collection($this->whenLoaded('jobs')),
            'user' => new UserResource($this->whenLoaded('user')),
            'currentCandidateJob' => new CandidateJobResource($this->whenLoaded('currentCandidateJob')),
        ];
    }

    private function finalScore() {
        try {
            $interviews = $this->currentCandidateJob->interviews->where('score', '>', 0);

            if (count($interviews) !== 0) {
                $finalScore = 0;
                foreach ($interviews as $interview) {
                    $finalScore += $interview->score;
                }

                return $finalScore / $interviews->count();
            }

            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
