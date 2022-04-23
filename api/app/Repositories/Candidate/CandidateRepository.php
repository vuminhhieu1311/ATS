<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Repositories\BaseRepository;

class CandidateRepository extends BaseRepository implements CandidateRepositoryInterface
{
    public function model()
    {
        return new Candidate();
    }
}
