<?php

namespace App\Repositories\Pipeline;

use App\Models\Pipeline;
use App\Repositories\BaseRepository;

class PipelineRepository extends BaseRepository implements PipelineRepositoryInterface
{
    public function model()
    {
        return new Pipeline();
    }
}
