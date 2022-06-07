<?php

namespace App\Repositories\AssessmentForm;

use App\Models\AssessmentForm;
use App\Repositories\BaseRepository;

class AssessmentFormRepository extends BaseRepository implements AssessmentFormRepositoryInterface
{
    public function model()
    {
        return new AssessmentForm();
    }
}
