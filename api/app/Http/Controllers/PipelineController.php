<?php

namespace App\Http\Controllers;

use App\Http\Resources\PipelineResource;
use App\Models\Pipeline;
use App\Repositories\Pipeline\PipelineRepositoryInterface;
use Illuminate\Http\Request;

class PipelineController extends Controller
{
    protected PipelineRepositoryInterface $pipelineRepository;

    public function __construct(PipelineRepositoryInterface $pipelineRepository) {
        $this->pipelineRepository = $pipelineRepository;
    }

    public function index()
    {
        $pipelines = $this->pipelineRepository->getAll([
            'stages',
            'jobs',
        ]);

        return PipelineResource::collection($pipelines);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Pipeline $pipeline)
    {
        //
    }

    public function update(Request $request, Pipeline $pipeline)
    {
        //
    }

    public function destroy(Pipeline $pipeline)
    {
        //
    }
}
