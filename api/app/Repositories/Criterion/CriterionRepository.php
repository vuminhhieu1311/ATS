<?php

namespace App\Repositories\Criterion;

use App\Models\Criterion;
use App\Repositories\BaseRepository;

class CriterionRepository extends BaseRepository implements CriterionRepositoryInterface
{
    public function model()
    {
        return new Criterion();
    }
}
