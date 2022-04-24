<?php

namespace App\Repositories\Job;

use App\Models\Job;
use App\Repositories\BaseRepository;

class JobRepository extends BaseRepository implements JobRepositoryInterface
{
    public function model()
    {
        return new Job();
    }

    public function queryAllByConditions($conditions = [], $relations = [])
    {
        $jobQuery = $this->model()->latest()->with($relations);

        if (array_key_exists('name', $conditions)) {
            $jobQuery = $jobQuery->where('name', 'LIKE', '%'.$conditions['name'].'%');
        }

        if (array_key_exists('status', $conditions)) {
            $jobQuery = $jobQuery->where('status', $conditions['status']);
        }

        if (array_key_exists('locations', $conditions)) {
            $jobQuery = $jobQuery->whereIn('city', $conditions['locations']);
        }

        if (array_key_exists('tags', $conditions)) {
            $jobQuery = $jobQuery->whereHas('tags', function ($query) use ($conditions) {
                return $query->whereIn('tags.name', $conditions['tags']);
            });
        }

        if (array_key_exists('types', $conditions)) {
            $jobQuery = $jobQuery->whereIn('type', $conditions['types']);
        }

        return $jobQuery->paginate();
    }
}
