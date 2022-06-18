<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssessmentFormResource;
use App\Http\Resources\InterviewResource;
use App\Models\AssessmentForm;
use App\Notifications\AddInterviewSchedule;
use App\Repositories\AssessmentForm\AssessmentFormRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentFormController extends Controller
{
    protected AssessmentFormRepositoryInterface $assessmentFormRepo;

    public function __construct(AssessmentFormRepositoryInterface $assessmentFormRepo)
    {
        $this->assessmentFormRepo = $assessmentFormRepo;
    }

    public function index(Request $request)
    {
        $queries = $request->query();
        $assessmentForms = $this->assessmentFormRepo->queryAllByConditions($queries, [
            'criteria',
        ]);

        return AssessmentFormResource::collection($assessmentForms);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $assessmentForm = $this->assessmentFormRepo->create([
                'name' => $request->input('name'),
            ]);

            $weights = $request->input('weights', []);
            foreach ($request->input('criterionIds', []) as $key => $value) {
                $assessmentForm->assessmentCriteria()->create([
                    'weight' => $weights[$key],
                    'criterion_id' => $value,
                ]);
            }

            DB::commit();

            return AssessmentFormResource::make($assessmentForm->load([
                'criteria',
            ]));
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssessmentForm  $assessmentForm
     * @return \Illuminate\Http\Response
     */
    public function show(AssessmentForm $assessmentForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssessmentForm  $assessmentForm
     * @return \Illuminate\Http\Response
     */
    public function edit(AssessmentForm $assessmentForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssessmentForm  $assessmentForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssessmentForm $assessmentForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssessmentForm  $assessmentForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssessmentForm $assessmentForm)
    {
        //
    }
}
