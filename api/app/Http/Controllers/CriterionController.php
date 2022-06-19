<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssessmentFormResource;
use App\Http\Resources\CriterionResource;
use App\Models\AssessmentForm;
use App\Models\Criterion;
use App\Repositories\Criterion\CriterionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriterionController extends Controller
{
    protected CriterionRepositoryInterface $criterionRepository;

    public function __construct(CriterionRepositoryInterface $criterionRepository)
    {
        $this->criterionRepository = $criterionRepository;
    }

    public function index()
    {
        $criteria = $this->criterionRepository->getAll([
            'questions',
        ]);

        return CriterionResource::collection($criteria);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $criterion = $this->criterionRepository->create([
                'name' => $request->input('name'),
            ]);

            foreach ($request->input('questionIds', []) as $id) {
                $criterion->criterionQuestions()->create([
                    'question_id' => $id,
                ]);
            }
            $criterion->questions()->sync($request->input('questionIds', []));

            DB::commit();

            return CriterionResource::make($criterion->load('questions'));
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function update(Request $request, Criterion $criterion)
    {
        try {
            DB::beginTransaction();

            $criterion->update([
                'name' => $request->input('name'),
            ]);

            $criterion->questions()->syncWithPivotValues($request->input('questionIds', []), [
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return CriterionResource::make($criterion->load('questions'));
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
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
