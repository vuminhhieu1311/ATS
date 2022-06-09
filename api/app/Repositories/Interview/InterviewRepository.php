<?php

namespace App\Repositories\Interview;

use App\Models\Interview;
use App\Repositories\BaseRepository;

class InterviewRepository extends BaseRepository implements InterviewRepositoryInterface
{
    public function model()
    {
        return new Interview();
    }


    public function queryAllByConditions($conditions = [], $relations = [])
    {
        return $this->model()
            ->when(array_key_exists('statuses', $conditions), function ($query) use ($conditions) {
                return $query->whereIn('status', $conditions['statuses']);
            })
            ->when(array_key_exists('candidate', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('candidateJob.candidate.user', function ($q) use ($conditions) {
                    $q->where('users.name', 'like', '%' . $conditions['candidate'] . '%')
                        ->orWhere('users.email', 'like', '%' . $conditions['candidate'] . '%')
                        ->orWhere('users.phone_number', 'like', '%' . $conditions['candidate'] . '%');
                });
            })
            ->when(array_key_exists('jobName', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('candidateJob.job', function ($q) use ($conditions) {
                    $q->where('jobs.name', 'like', '%' . $conditions['jobName'] . '%');
                });
            })
            ->when(array_key_exists('interviewer', $conditions), function ($query) use ($conditions) {
                return $query->whereHas('interviewers.user', function ($q) use ($conditions) {
                    $q->where('users.name', 'like', '%' . $conditions['interviewer'] . '%')
                        ->orWhere('users.email', 'like', '%' . $conditions['interviewer'] . '%')
                        ->orWhere('users.phone_number', 'like', '%' . $conditions['interviewer'] . '%');
                });
            })
            ->latest()->with($relations)->get();
    }
}
