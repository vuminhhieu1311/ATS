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

    public function queryAllByConditions($conditions = [], $relations = [])
    {
        return $this->model()
            ->when(array_key_exists('name', $conditions), function ($query) use ($conditions) {
                return $query->where('name', 'LIKE', '%' . $conditions['name'] . '%');
            })
            ->when(array_key_exists('createdAt', $conditions), function ($query) use ($conditions) {
                return $query->whereDate('created_at', $conditions['createdAt']);
            })
            ->latest()->with($relations)->get();
    }
}
