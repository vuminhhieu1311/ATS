<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;

class PipelineStageResource extends ShareResource
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
            'pipelineId' => $this->pipeline_id,
            'stageId' => $this->stage_id,
            'order' => $this->order,
        ];
    }
}
