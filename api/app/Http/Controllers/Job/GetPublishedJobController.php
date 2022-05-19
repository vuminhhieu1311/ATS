<?php

namespace App\Http\Controllers\Job;

use App\Enums\Job\JobStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Models\Job;

class GetPublishedJobController extends Controller
{
    public function __invoke(Job $job)
    {
        abort_if($job->status !== JobStatus::PUBLISHED, 403);

        $job->load([
            'tags',
        ]);

        return JobResource::make($job);
    }
}
