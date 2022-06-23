<?php

namespace App\Repositories\Permission;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function model()
    {
        return new Permission();
    }

    public function queryAllByConditions($conditions, $relations = [])
    {
        return $this->model()
            ->when(optional($conditions)['permissionName'], function ($query) use ($conditions) {
                return $query->where('name', 'LIKE', '%' . $conditions['permissionName'] . '%');
            })
            ->latest()->with($relations);
    }
}
