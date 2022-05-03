<?php

namespace App\Http\Controllers;

use App\Enums\Interview\InterviewStaffType;
use App\Enums\Interview\InterviewStatus;
use App\Http\Resources\InterviewResource;
use App\Models\Interview;
use App\Repositories\CandidateJob\CandidateJobRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    protected CandidateJobRepositoryInterface $candidateJobRepo;

    public function __construct(CandidateJobRepositoryInterface $candidateJobRepo)
    {
        $this->candidateJobRepo = $candidateJobRepo;
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
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
            ]);

            $interview->interviewStaffs()->create([
                'type' => InterviewStaffType::SCHEDULER,
                'staff_id' => optional(Auth::user())->staff->id,
            ]);

            foreach ($request->input('staffs', []) as $staffId) {
                $interview->interviewStaffs()->create([
                    'type' => InterviewStaffType::INTERVIEWER,
                    'staff_id' => $staffId,
                ]);
                // Send notification to interviewers
            }

            if ($request->input('isSendMail')) {
                // Send mail to candidate
            }

            DB::commit();

            return InterviewResource::make($interview->load('candidateJob.job'));
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function show(Interview $interview)
    {
        //
    }

    public function update(Request $request, Interview $interview)
    {
        //
    }

    public function destroy(Interview $interview)
    {
        //
    }
}
