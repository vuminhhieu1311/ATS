<?php

namespace App\Repositories\CandidateJob;

use App\Models\CandidateJob;
use App\Repositories\BaseRepository;

class CandidateJobRepository extends BaseRepository implements CandidateJobRepositoryInterface
{
    public function model()
    {
        return new CandidateJob();
    }
}
