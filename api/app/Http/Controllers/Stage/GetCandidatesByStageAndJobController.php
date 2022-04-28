<?php

namespace App\Http\Controllers\Stage;

use App\Http\Controllers\Controller;
use App\Http\Resources\CandidateResource;
use App\Models\Pipeline;
use App\Models\Stage;
use Illuminate\Http\Request;

class GetCandidatesByStageAndJobController extends Controller
{
    public function __invoke(Request $request, Stage $stage, Pipeline $pipeline, $jobId)
    {
        $candidates = $stage->candidates()
            ->wherePivot('is_active', true)
            ->with('user');

        if ($jobId) {
            $candidates = $candidates->wherePivot('job_id', $jobId);
        } else {
            $jobIds = $pipeline->jobs()->pluck('id');
            $candidates = $candidates->wherePivotIn('job_id', $jobIds);
        }

        return CandidateResource::collection($candidates->paginate());
    }
}
