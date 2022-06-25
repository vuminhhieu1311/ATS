<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RemoveRolesFromPermissionController extends Controller
{
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function __invoke(Request $request, Permission $permission)
    {
        foreach ($request->input('roleDeletedIds', []) as $roleId) {
            $role = $this->roleRepository->findOrFail($roleId);
            $role->revokePermissionTo($permission->name);
        }

        return PermissionResource::make($permission);
    }
}
