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
            ->when(array_key_exists('keyword', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('user', function ($q) use ($conditions) {
                    return $q->where('name', 'LIKE', '%' . $conditions['keyword'] . '%')
                        ->orWhere('email', 'LIKE', '%' . $conditions['keyword'] . '%')
                        ->orWhere('phone_number', 'LIKE', '%' . $conditions['keyword'] . '%');
                });
            })
            ->when(array_key_exists('jobId', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('currentCandidateJob', function ($q) use ($conditions) {
                    return $q->where('job_id', $conditions['jobId']);
                });
            })
            ->when(array_key_exists('pipelineId', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('currentCandidateJob.job', function ($q) use ($conditions) {
                    return $q->where('pipeline_id', $conditions['pipelineId']);
                });
            })
            ->when(array_key_exists('stageId', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('currentCandidateJob', function ($q) use ($conditions) {
                    return $q->where('stage_id', $conditions['stageId']);
                });
            })
            ->when(array_key_exists('isStar', $conditions), function ($query) use ($conditions) {
                $isStar = filter_var($conditions['isStar'], FILTER_VALIDATE_BOOLEAN);
                return $query->where('is_star', $isStar);
            })
            ->with($relations)
            ->latest()
            ->paginate();
    }
}
