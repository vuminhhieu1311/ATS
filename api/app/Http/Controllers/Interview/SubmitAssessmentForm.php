<?php

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Http\Resources\CriterionResultResource;
use App\Http\Resources\InterviewResource;
use App\Models\Interview;
use App\Repositories\CriterionResult\CriterionResultRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmitAssessmentForm extends Controller
{
    protected CriterionResultRepositoryInterface $criterionResultRepo;

    public function __construct(CriterionResultRepositoryInterface $criterionResultRepo)
    {
        $this->criterionResultRepo = $criterionResultRepo;
    }

    public function __invoke(Request $request, Interview $interview)
    {
        try {
            DB::beginTransaction();
            $staff = Auth::user()->staff;
            $interviewStaff = $interview->interviewStaffs()->where('staff_id', $staff->id)->first();

            if ($interviewStaff) {
                $assessmentForm = $interview->assessmentForm;
                $rates = $request->input('rates');
                $notes = $request->input('notes');

                $criteria = $interview->assessmentForm->criteria;
                $totalWeight = 0;
                $totalScore = 0;

                foreach ($criteria as $key => $value) {
                    $this->criterionResultRepo->updateOrCreate(
                        [
                            'interview_staff_id' => $interviewStaff->id,
                            'criterion_id' => $value->id,
                        ],
                        [
                            'score' => $rates[$key],
                            'note' => $notes[$key],
                        ]
                    );
                    $assessmentCriterion = $assessmentForm->assessmentCriteria()->where([
                        'criterion_id' => $value->id,
                    ])->first();
                    $totalWeight += $assessmentCriterion->weight;
                    $totalScore += $rates[$key] * $assessmentCriterion->weight;
                }

                $interviewStaff->update([
                    'score' => $totalScore / $totalWeight,
                ]);

                $interviewStaffs = $interview->interviewStaffs->where('score', '>', 0);
                $finalScore = 0;
                foreach ($interviewStaffs as $staff) {
                    $finalScore += $staff->score;
                }
                $interview->update([
                    'score' => $finalScore / $interviewStaffs->count(),
                ]);
                DB::commit();

                $interview->load([
                    'candidateJob.job',
                    'candidateJob.candidate.user',
                    'interviewers.user',
                    'assessmentForm.criteria',
                    'interviewStaffs.criterionResults',
                ]);

                $interviewStaffIds = $interview->interviewStaffs->pluck('id')->toArray();
                foreach ($interview->assessmentForm->criteria as $criterion) {
                    $scores = $criterion->criterionResults()
                        ->whereIn('interview_staff_id', $interviewStaffIds)
                        ->pluck('score')->toArray();
                    $criterion->average_score = array_sum($scores) / count($scores);
                }

                return InterviewResource::make($interview);
            }

            return null;
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }
}
