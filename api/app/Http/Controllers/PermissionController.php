<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected PermissionRepositoryInterface $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        $queries = $request->query();
        $permissions = $this->permissionRepository->queryAllByConditions($queries)->get();

        return PermissionResource::collection($permissions);
    }
}
