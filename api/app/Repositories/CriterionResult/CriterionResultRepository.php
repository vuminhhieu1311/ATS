<?php

namespace App\Repositories\CriterionResult;

use App\Models\CriterionResult;
use App\Repositories\BaseRepository;

class CriterionResultRepository extends BaseRepository implements CriterionResultRepositoryInterface
{
    public function model()
    {
        return new CriterionResult();
    }
}
