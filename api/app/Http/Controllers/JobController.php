<?php

namespace App\Http\Controllers;

use App\Http\Requests\Job\JobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Repositories\Job\JobRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    protected JobRepositoryInterface $jobRepository;

    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function index()
    {
        $jobs = $this->jobRepository->queryAllByConditions([], [
            'pipeline',
            'tags',
        ]);

        return JobResource::collection($jobs);
    }

    public function store(JobRequest $request)
    {
        try {
            DB::beginTransaction();

            $job = $this->jobRepository->create([
                'name' => $request->input('name'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'employment_type' => $request->input('employmentType'),
                'min_offer' => $request->input('minOffer'),
                'max_offer' => $request->input('maxOffer'),
                'currency' => $request->input('currency'),
                'deadline' => $request->input('deadline'),
                'description' => $request->input('description'),
                'requirement' => $request->input('requirement'),
                'benefit' => $request->input('benefit'),
                'status' => $request->input('status'),
                'pipeline_id' => $request->input('pipeline_id', 0),
            ]);

            DB::commit();

            return JobResource::make($job);
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function show(Job $job)
    {
        //
    }

    public function update(Request $request, Job $job)
    {
        //
    }

    public function destroy(Job $job)
    {
        //
    }
}
