<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class PipelineResource extends ShareResource
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
            'jobs' => JobResource::collection($this->whenLoaded('jobs')),
            'stages' => StageResource::collection($this->whenLoaded('stages')),
        ];
    }
}
