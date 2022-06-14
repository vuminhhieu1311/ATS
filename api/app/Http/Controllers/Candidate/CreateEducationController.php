<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationResource;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CreateEducationController extends Controller
{
    public function __invoke(Request $request, Candidate $candidate)
    {
        $education = $candidate->education()->create([
            'school_name' => $request->input('schoolName'),
            'field_of_study' => $request->input('fieldOfStudy'),
            'degree' => $request->input('degree'),
            'grade' => $request->input('grade'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
        ]);

        return EducationResource::make($education);
    }
}
