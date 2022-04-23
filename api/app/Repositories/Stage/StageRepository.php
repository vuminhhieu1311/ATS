<?php

namespace App\Repositories\Stage;

use App\Models\Stage;
use App\Repositories\BaseRepository;

class StageRepository extends BaseRepository implements StageRepositoryInterface
{
    public function model()
    {
        return new Stage();
    }
}
