<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;

class UpdateCandidateStar extends Controller
{
    public function __invoke(Candidate $candidate)
    {
        $candidate->update([
            'is_star' => !$candidate->is_star,
        ]);

        return CandidateResource::make($candidate);
    }
}
