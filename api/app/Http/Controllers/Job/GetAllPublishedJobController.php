<?php

namespace App\Http\Controllers\Job;

use App\Enums\Job\JobStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Repositories\Job\JobRepositoryInterface;
use Illuminate\Http\Request;

class GetAllPublishedJobController extends Controller
{
    protected JobRepositoryInterface $jobRepository;

    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function __invoke(Request $request)
    {
        $queries = $request->query();
        $conditions = array_merge($queries, [
            'status' => JobStatus::PUBLISHED,
        ]);

        $jobs = $this->jobRepository->queryAllByConditions($conditions, [
            'tags',
        ]);

        return JobResource::collection($jobs);
    }
}
