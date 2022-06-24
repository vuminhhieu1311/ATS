<?php

namespace App\Repositories\Permission;

use App\Repositories\BaseRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function model()
    {
        return new Permission();
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
