<?php

namespace App\Http\Controllers;

use App\Http\Resources\AssessmentFormResource;
use App\Http\Resources\CriterionResource;
use App\Models\AssessmentForm;
use App\Repositories\AssessmentForm\AssessmentFormRepositoryInterface;
use App\Repositories\Criterion\CriterionRepositoryInterface;
use Illuminate\Http\Request;

class CriterionController extends Controller
{
    protected CriterionRepositoryInterface $criterionRepository;

    public function __construct(CriterionRepositoryInterface $criterionRepository)
    {
        $this->criterionRepository = $criterionRepository;
    }

    public function index()
    {
        $criteria = $this->criterionRepository->getAll();

        return CriterionResource::collection($criteria);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
