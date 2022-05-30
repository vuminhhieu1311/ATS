<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function store(Request $request)
    {
        $candidate = Auth::user()->candidate;

        $candidate->experiences()->create([
            'company_name' => $request->input('companyName'),
            'position' => $request->input('position'),
            'summary' => $request->input('summary'),
            'start_date' => $request->input('startDate'),
            'end_date' => $request->input('endDate'),
        ]);

        return optional(Auth::user())->load([
            'candidate.education',
            'candidate.experiences',
            'staff',
        ]);
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

        return optional(Auth::user())->load([
            'candidate.education',
            'candidate.experiences',
            'staff',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return optional(Auth::user())->load([
            'candidate.education',
            'candidate.experiences',
            'staff',
        ]);
    }
}
