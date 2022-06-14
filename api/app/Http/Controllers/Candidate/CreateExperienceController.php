<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExperienceResource;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CreateExperienceController extends Controller
{
    public function __invoke(Request $request, Candidate $candidate)
    {
        $experience = $candidate->experiences()->create([
            'company_name' => $request->input('companyName'),
            'position' => $request->input('position'),
            'summary' => $request->input('summary'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
        ]);

        return ExperienceResource::make($experience);
    }
}
