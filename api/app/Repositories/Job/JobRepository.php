<?php

namespace App\Repositories\Job;

use App\Models\Job;
use App\Repositories\BaseRepository;

class JobRepository extends BaseRepository implements JobRepositoryInterface
{
    public function model()
    {
        return new Job();
    }
}
