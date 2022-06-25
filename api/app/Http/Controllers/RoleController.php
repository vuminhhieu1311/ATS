<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Repositories\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index(Request $request)
    {
        $queries = $request->query();
        $roles = $this->roleRepository->queryAllByConditions($queries)->get();

        return RoleResource::collection($roles);
    }
}
