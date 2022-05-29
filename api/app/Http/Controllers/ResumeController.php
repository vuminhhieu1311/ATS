<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResumeResource;
use App\Models\Candidate;
use App\Models\Resume;
use App\Repositories\Resume\ResumeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    protected ResumeRepositoryInterface $resumeRepository;

    public function __construct(ResumeRepositoryInterface $resumeRepository) {
        $this->resumeRepository = $resumeRepository;
    }

    public function index()
    {
        $candidate = Auth::user()->candidate;
        $resumes = $candidate->resumes;

        return ResumeResource::collection($resumes);
    }

    public function store(Request $request)
    {
        $resume = $this->resumeRepository->create([
            'candidate_id' => 1,
        ]);

        return ResumeResource::make($resume);
    }

    public function show(Resume $resume)
    {
        return ResumeResource::make($resume);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resume $resume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume)
    {
        //
    }

    public function saveContent(Request $request, Resume $resume)
    {
        $resume->update([
            'content' => json_encode($request->all()),
        ]);

        return response()->json(json_decode($resume->content));
    }

    public function loadContent(Resume $resume)
    {
        return response()->json(json_decode($resume->content));
    }
}
