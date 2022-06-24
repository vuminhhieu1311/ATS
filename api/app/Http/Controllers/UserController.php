<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $queries = $request->query();
        $users = $this->userRepository->queryAllByConditions($queries)->paginate();

        return UserResource::collection($users);
    }
}
