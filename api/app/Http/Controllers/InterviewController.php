<?php

namespace App\Http\Controllers;

use App\Enums\Interview\InterviewStatus;
use App\Http\Requests\Interview\InterviewRequest;
use App\Http\Resources\InterviewResource;
use App\Models\Interview;
use App\Notifications\AddInterviewSchedule;
use App\Repositories\CandidateJob\CandidateJobRepositoryInterface;
use App\Repositories\Interview\InterviewRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    protected CandidateJobRepositoryInterface $candidateJobRepo;
    protected InterviewRepositoryInterface $interviewRepository;

    public function __construct(CandidateJobRepositoryInterface $candidateJobRepo, InterviewRepositoryInterface $interviewRepository)
    {
        $this->candidateJobRepo = $candidateJobRepo;
        $this->interviewRepository = $interviewRepository;
    }

    public function index()
    {
        $interviews = $this->interviewRepository->queryAllByConditions([], [
            'candidateJob.job',
            'candidateJob.candidate.user',
            'interviewers.user',
        ]);

        return InterviewResource::collection($interviews);
    }

    public function store(InterviewRequest $request)
    {
        $candidateJob = $this->candidateJobRepo->findOrFail($request->input('candidateJobId'));
        $inProgress = $candidateJob->load([
            'interviews' => function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->input('startTime'), $request->input('endTime')]);
            },
        ]);
        abort_if(!$inProgress->interviews->isEmpty(), 403, 'Another interview had already been set for this time!');

        try {
            DB::beginTransaction();

            $interview = $candidateJob->interviews()->create([
                'name' => $request->input('name'),
                'start_time' => $request->input('startTime'),
                'end_time' => $request->input('endTime'),
                'note' => $request->input('note'),
                'is_online' => $request->input('isOnline'),
                'status' => InterviewStatus::NEW,
                'mail_template_id' => $request->input('mailTemplateId'),
                'mail_title' => $request->input('mailTitle'),
                'mail_content' => $request->input('mailContent'),
                'room_id' => $request->input('roomId'),
                'staff_id' => optional(Auth::user())->staff->id,
            ]);

            if ($interview->is_online) {
                $interview->update([
                    'link' => env('SPA_URL') . '/meeting/' . $interview->id,
                ]);
            }

            foreach ($request->input('staffs', []) as $staffId) {
                $interview->interviewStaffs()->create([
                    'staff_id' => $staffId,
                ]);
                // Send notification to interviewers
            }

            DB::commit();

            return InterviewResource::make($interview->load([
                'candidateJob.job',
                'candidateJob.candidate.user',
                'interviewers.user',
            ]));
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function show(Interview $interview)
    {
        $interview->load([
            'candidateJob.job',
            'candidateJob.candidate.user',
            'interviewers.user',
        ]);

        return InterviewResource::make($interview);
    }

    public function update(InterviewRequest $request, Interview $interview)
    {
        $inProgress = $interview->candidateJob->load([
            'interviews' => function ($query) use ($request, $interview) {
                $query->where('id', '!=', $interview->id)
                    ->whereBetween('start_time', [$request->input('startTime'), $request->input('endTime')]);
            },
        ]);
        abort_if(!$inProgress->interviews->isEmpty(), 403, 'Another interview had already been set for this time frame!');

        try {
            DB::beginTransaction();

            $interview->update([
                'name' => $request->input('name'),
                'start_time' => $request->input('startTime'),
                'end_time' => $request->input('endTime'),
                'note' => $request->input('note'),
                'is_online' => $request->input('isOnline'),
                'status' => $request->input('status'),
                'mail_template_id' => $request->input('mailTemplateId'),
                'mail_title' => $request->input('mailTitle'),
                'mail_content' => $request->input('mailContent'),
                'room_id' => $request->input('roomId'),
            ]);

            $interview->interviewers()->syncWithPivotValues($request->input('staffs', []), [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            // Send notification to interviewers

            if ($request->input('isSendMail')) {
                $candidate = $interview->candidateJob->candidate;
                $candidate->notify(new AddInterviewSchedule($interview));
            }

            DB::commit();

            return InterviewResource::make($interview->load([
                'candidateJob.job',
                'candidateJob.candidate.user',
                'interviewers.user',
            ]));
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function destroy(Interview $interview)
    {
        //
    }
}
