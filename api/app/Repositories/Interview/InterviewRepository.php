<?php

namespace App\Repositories\Interview;

use App\Models\Interview;
use App\Repositories\BaseRepository;

class InterviewRepository extends BaseRepository implements InterviewRepositoryInterface
{
    public function model()
    {
        return new Interview();
    }
}
