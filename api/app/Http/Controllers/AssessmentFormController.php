<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssessmentFormResource;
use App\Models\AssessmentForm;
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

    public function show(AssessmentForm $assessmentForm)
    {
        $assessmentForm->load('criteria.questions');

        return AssessmentFormResource::make($assessmentForm);
    }

    public function update(Request $request, AssessmentForm $assessmentForm)
    {
        try {
            DB::beginTransaction();

            $assessmentForm->update([
                'name' => $request->input('name'),
            ]);

            $weights = $request->input('weights', []);
            $assessmentForm->criteria()->syncWithPivotValues($request->input('criterionIds', []), [
                'created_at' => now(),
                'updated_at' => now(),
                'weight' => 1,
            ]);

            foreach ($assessmentForm->assessmentCriteria as $key => $assessmentCriterion) {
                $assessmentCriterion->update([
                    'weight' => $weights[$key],
                ]);
            }

            DB::commit();

            return AssessmentFormResource::make($assessmentForm->load('criteria'));
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function destroy(AssessmentForm $assessmentForm)
    {
        $assessmentForm->assessmentCriteria()->delete();

        return $assessmentForm->delete();
    }
}
