<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function model()
    {
        return new Tag();
    }

    public function queryAllByConditions($conditions = [], $relations = [])
    {
        return $this->model()
            ->where($conditions)
            ->withCount('jobs')
            ->with($relations)
            ->orderBy('jobs_count', 'desc')
            ->take(15)
            ->get();
    }
}
