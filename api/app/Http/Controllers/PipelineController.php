<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pipeline\PipelineRequest;
use App\Http\Resources\PipelineResource;
use App\Models\Pipeline;
use App\Repositories\Job\JobRepositoryInterface;
use App\Repositories\Pipeline\PipelineRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class PipelineController extends Controller
{
    protected PipelineRepositoryInterface $pipelineRepository;
    protected JobRepositoryInterface $jobRepository;

    public function __construct(
        PipelineRepositoryInterface $pipelineRepository,
        JobRepositoryInterface $jobRepository
    ) {
        $this->pipelineRepository = $pipelineRepository;
        $this->jobRepository = $jobRepository;
    }

    public function index()
    {
        $pipelines = $this->pipelineRepository->getAll([
            'stages',
            'jobs',
        ]);

        return PipelineResource::collection($pipelines);
    }

    public function store(PipelineRequest $request)
    {
        try {
            DB::beginTransaction();
            $pipeline = $this->pipelineRepository->create([
                'name' => $request->input('name'),
            ]);

            foreach ($request->input('stageIds', []) as $key => $stageId) {
                $pipeline->pipelineStages()->create([
                    'stage_id' => $stageId,
                    'order' => $key + 1,
                ]);
            }

            foreach ($request->input('jobIds', []) as $jobId) {
                $this->jobRepository->updateOrCreate(
                    ['id' => $jobId],
                    ['pipeline_id' => $pipeline->id]
                );
            }

            DB::commit();

            return PipelineResource::make($pipeline);
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function show(Pipeline $pipeline)
    {
        $pipeline->load([
            'stages',
            'jobs',
        ]);

        return PipelineResource::make($pipeline);
    }

    public function update(PipelineRequest $request, Pipeline $pipeline)
    {
        try {
            DB::beginTransaction();
            $pipeline->update([
                'name' => $request->input('name'),
            ]);

            $stageIds = $request->input('stageIds', []);
            $data = [];

            foreach ($stageIds as $key => $stageId) {
                $data[$stageId] = [
                    'order' => $key + 1,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $pipeline->stages()->sync($data);

            $jobIds = $request->input('jobIds', []);

            foreach ($pipeline->jobs as $job) {
                if (!in_array($job->id, $jobIds, true)) {
                    $job->update([
                        'pipeline_id' => 0,
                    ]);
                }
            }

            foreach ($jobIds as $jobId) {
                $this->jobRepository->update(
                    ['id' => $jobId],
                    ['pipeline_id' => $pipeline->id]
                );
            }

            DB::commit();

            return PipelineResource::make($pipeline);
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
