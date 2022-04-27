<?php

namespace App\Repositories\Candidate;

use App\Repositories\RepositoryInterface;

interface CandidateRepositoryInterface extends RepositoryInterface
{
    public function queryAllByConditions($conditions = [], $relations = []);
}
