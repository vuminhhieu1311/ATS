<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class ResumeResource extends ShareResource
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
            'uuid' => $this->uuid,
            'content' => $this->content,
            'templateId' => $this->template_id,
            'updatedAt' => $this->updated_at,
            'candidate' => new CandidateResource($this->whenLoaded('candidate')),
            'template' => new ResumeTemplateResource($this->whenLoaded('template')),
        ];
    }
}
