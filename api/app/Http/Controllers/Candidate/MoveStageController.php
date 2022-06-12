<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Models\Stage;

class MoveStageController extends Controller
{
    public function __invoke(Candidate $candidate, Stage $stage)
    {
        $candidate->currentCandidateJob->update([
            'stage_id' => $stage->id,
        ]);

        return CandidateResource::make($candidate->load([
            'currentCandidateJob',
        ]));
    }
}
