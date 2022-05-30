<?php

namespace App\Repositories\Education;

use App\Models\Education;
use App\Repositories\BaseRepository;

class EducationRepository extends BaseRepository implements EducationRepositoryInterface
{
    public function model()
    {
        return new Education();
    }
}
