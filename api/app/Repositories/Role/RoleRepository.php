<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function model()
    {
        return new Role();
    }

    public function queryAllByConditions($conditions, $relations = [])
    {
        return $this->model()
            ->when(optional($conditions)['name'], function ($query) use ($conditions) {
                return $query->where('name', 'LIKE', '%' . $conditions['name'] . '%');
            })
            ->latest();
    }
}
