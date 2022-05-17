<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Repositories\Job\JobRepositoryInterface;
use Illuminate\Http\Request;

class GetAllLocationController extends Controller
{
    protected JobRepositoryInterface $jobRepository;

    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function __invoke(Request $request)
    {
        $condition = [
            ['city', 'like', '%' . $request->query('keyword') . '%'],
        ];
        $locations = $this->jobRepository->getAllLocations($condition);

        return response()->json(['data' => $locations]);
    }
}
