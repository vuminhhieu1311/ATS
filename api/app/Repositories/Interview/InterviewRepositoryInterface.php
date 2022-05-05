<?php

namespace App\Repositories\Interview;

use App\Repositories\RepositoryInterface;

interface InterviewRepositoryInterface extends RepositoryInterface
{
    public function queryAllByConditions($conditions = [], $relations = []);
}
