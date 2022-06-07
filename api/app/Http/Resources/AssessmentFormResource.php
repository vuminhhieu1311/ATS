<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;
use Illuminate\Http\Resources\MissingValue;

class AssessmentFormResource extends ShareResource
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
            'criteria' => CriterionResource::collection($this->whenLoaded('criteria')),
        ];
    }
}
