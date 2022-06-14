<?php

namespace App\Http\Controllers;

use App\Http\Resources\EducationResource;
use App\Models\Education;
use App\Repositories\Education\EducationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    protected EducationRepositoryInterface $educationRepository;

    public function __construct(EducationRepositoryInterface $educationRepository) {
        $this->educationRepository = $educationRepository;
    }

    public function store(Request $request)
    {
        $education = $this->educationRepository->create([
            'school_name' => $request->input('schoolName'),
            'field_of_study' => $request->input('fieldOfStudy'),
            'degree' => $request->input('degree'),
            'grade' => $request->input('grade'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
            'candidate_id' => Auth::user()->candidate->id,
        ]);

        return EducationResource::make($education);
    }

    public function update(Request $request, Education $education)
    {
        $education->update([
            'school_name' => $request->input('schoolName'),
            'field_of_study' => $request->input('fieldOfStudy'),
            'degree' => $request->input('degree'),
            'grade' => $request->input('grade'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
        ]);

        return EducationResource::make($education);
    }

    public function destroy(Education $education)
    {
        return $education->delete();
    }
}
