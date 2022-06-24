<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return new User();
    }

    public function queryAllByConditions($conditions, $relations = [])
    {
        return $this->model()
            ->when(optional($conditions)['keyword'], function ($query) use ($conditions) {
                return $query->where(function ($q) use ($conditions) {
                    return $q->where('name', 'like', '%' . $conditions['keyword'] . '%')
                        ->orWhere('email', 'like', '%' . $conditions['keyword'] . '%');
                });
            })
            ->latest()->with($relations);
    }
}
