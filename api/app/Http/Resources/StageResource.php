<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;
use Illuminate\Http\Resources\MissingValue;

class StageResource extends ShareResource
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
            'type' => $this->type,
            'isActive' => $this->is_active,
            'order' => $this->pivot->order ?? new MissingValue(),
            'pipelines' => PipelineResource::collection($this->whenLoaded('pipelines')),
        ];
    }
}
