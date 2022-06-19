<?php

namespace App\Repositories\Question;

use App\Models\Question;
use App\Repositories\BaseRepository;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    public function model()
    {
        return new Question();
    }
}
