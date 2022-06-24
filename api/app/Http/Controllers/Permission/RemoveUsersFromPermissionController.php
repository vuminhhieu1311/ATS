<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RemoveUsersFromPermissionController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(Request $request, Permission $permission)
    {
        foreach ($request->input('userDeletedIds', []) as $userId) {
            $user = $this->userRepository->findOrFail($userId);
            $user->revokePermissionTo($permission->name);
        }

        return PermissionResource::make($permission);
    }
}
