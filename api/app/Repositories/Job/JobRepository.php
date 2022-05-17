<?php

namespace App\Repositories\Job;

use App\Models\Job;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class JobRepository extends BaseRepository implements JobRepositoryInterface
{
    public function model()
    {
        return new Job();
    }

    public function queryAllByConditions($conditions = [], $relations = [])
    {
        return $this->model()
            ->when(array_key_exists('name', $conditions), function ($query) use ($conditions) {
                return $query->where('name', 'LIKE', '%' . $conditions['name'] . '%');
            })
            ->when(array_key_exists('status', $conditions), function ($query) use ($conditions) {
                return $query->where('status', $conditions['status']);
            })
            ->when(array_key_exists('locations', $conditions), function ($query) use ($conditions) {
                return $query->whereIn('city', $conditions['locations']);
            })
            ->when(array_key_exists('tags', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('tags', function ($query) use ($conditions) {
                    return $query->whereIn('tags.name', $conditions['tags']);
                });
            })
            ->when(array_key_exists('types', $conditions), function ($query) use ($conditions) {
                return $query->whereIn('employment_type', $conditions['types']);
            })

            ->when(array_key_exists('pipelineName', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('pipeline', function ($q) use ($conditions) {
                    return $q->where('name', $conditions['pipelineName']);
                });
            })
            ->when(array_key_exists('location', $conditions), function ($query) use ($conditions) {
                return $query->where(function ($q) use ($conditions) {
                    return $q->where('city', '~*', $conditions['location'])
                        ->orWhere('country', '~*', $conditions['location']);
                });
            })
            ->when(array_key_exists('tag', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('tags', function ($query) use ($conditions) {
                    return $query->where('tags.name', $conditions['tag']);
                });
            })
            ->when(array_key_exists('type', $conditions), function ($query) use ($conditions) {
                return $query->where('employment_type', $conditions['type']);
            })
            ->latest()->with($relations)->paginate(10);
    }

    public function getAllLocations($conditions = [])
    {
        return $this->model()
            ->where($conditions)
            ->select('city', DB::raw('count(*) as jobs_count'))
            ->groupBy('city')
            ->orderBy('jobs_count', 'desc')
            ->take(10)
            ->get();
    }
}
