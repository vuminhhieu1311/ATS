<?php

namespace App\Repositories\AssessmentForm;

use App\Repositories\RepositoryInterface;

interface AssessmentFormRepositoryInterface extends RepositoryInterface
{
    public function queryAllByConditions($conditions = [], $relations = []);
}
