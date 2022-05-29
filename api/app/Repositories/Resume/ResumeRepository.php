<?php

namespace App\Repositories\Resume;

use App\Models\Candidate;
use App\Models\Resume;
use App\Repositories\BaseRepository;

class ResumeRepository extends BaseRepository implements ResumeRepositoryInterface
{
    public function model()
    {
        return new Resume();
    }
}
