<?php

namespace App\Repositories\Candidate;

use App\Models\Candidate;
use App\Repositories\BaseRepository;

class CandidateRepository extends BaseRepository implements CandidateRepositoryInterface
{
    public function model()
    {
        return new Candidate();
    }

    public function queryAllByConditions($conditions = [], $relations = [])
    {
        return $this->model()
            ->when(array_key_exists('name', $conditions), function ($query) use ($conditions) {
                return $query->where(function ($q) use ($conditions) {
                    return $q->where('name', 'like', '%'.$conditions['keyword'].'%')
                        ->orWhere('email', 'like', '%'.$conditions['keyword'].'%')
                        ->orWhere('phone_number', 'like', '%'.$conditions['keyword'].'%');
                });
            })
            ->with($relations)
            ->latest()
            ->paginate();
    }
}
