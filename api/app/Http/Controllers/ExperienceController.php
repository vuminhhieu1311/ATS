<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $candidate = Auth::user()->candidate;

        $experience = $candidate->experiences()->create([
            'company_name' => $request->input('companyName'),
            'position' => $request->input('position'),
            'summary' => $request->input('summary'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
        ]);

        return ExperienceResource::make($experience);
    }

    public function update(Request $request, Experience $experience)
    {
        $experience->update([
            'company_name' => $request->input('companyName'),
            'position' => $request->input('position'),
            'summary' => $request->input('summary'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
        ]);

        return ExperienceResource::make($experience);
    }

    public function destroy(Experience $experience)
    {
        return $experience->delete();
    }
}
