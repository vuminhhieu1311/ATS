<?php

namespace App\Http\Controllers\Job;

use App\Enums\Candidate\CandidateStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\StoreCandidateRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Job;
use App\Repositories\Candidate\CandidateRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateCandidateController extends Controller
{
    protected CandidateRepositoryInterface $candidateRepository;

    public function __construct(CandidateRepositoryInterface $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function __invoke(StoreCandidateRequest $request, Job $job)
    {
        try {
            DB::beginTransaction();

            $filePath = $request->file('resume')->store('resumes');
            Auth::loginUsingId(1);
            $authUser = optional(Auth::user());

            $authUser->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phoneNumber'),
            ]);

            if (!$authUser->candidate) {
                $authUser->candidate()->create([
                    'resume_url' => $filePath,
                    'status' => CandidateStatus::NEW,
                ]);
            } else {
                $authUser->candidate->update([
                    'resume_url' => $filePath,
                    'status' => CandidateStatus::NEW,
                ]);
            }

            $stage = optional($job->pipeline)->stages[0];
            $job->candidateJobs()->create([
                'candidate_id' => $authUser->candidate->id,
                'job_id' => $job->id,
                'stage_id' => optional($stage)->id,
            ]);

            DB::commit();

            return CandidateResource::make($authUser->candidate->load('user'));
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }
}
