<?php

namespace App\Http\Resources;

use App\Http\Resources\Custom\ShareResource;
use Illuminate\Http\Resources\MissingValue;

class CriterionResource extends ShareResource
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
            'averageScore' => $this->average_score ?? new MissingValue(),
        ];
    }
}
