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
            ->when($request->query('isStar'), function ($query) use ($request) {
                return $query->where('is_star', filter_var($request->query('isStar'), FILTER_VALIDATE_BOOLEAN));
            })
            ->when($request->query('candidate'), function ($query) use ($request) {
                return $query->whereHas('user', function ($q) use ($request) {
                    return $q->where('name', 'like', '%' . $request->query('candidate') . '%')
                        ->orWhere('email', 'like', '%' . $request->query('candidate') . '%')
                        ->orWhere('phone_number', 'like', '%' . $request->query('candidate') . '%');
                });
            })
            ->with([
                'user',
                'currentCandidateJob.interviews',
            ])->latest('updated_at');

        if ($jobId) {
            $candidates = $candidates->wherePivot('job_id', $jobId);
        } else {
            $jobIds = $pipeline->jobs()->pluck('id');
            $candidates = $candidates->wherePivotIn('job_id', $jobIds);
        }

        return CandidateResource::collection($candidates->paginate());
    }
}
