<?php

namespace App\Http\Controllers;

use App\Http\Resources\StaffResource;
use App\Models\Staff;
use App\Repositories\Staff\StaffRepositoryInterface;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    protected StaffRepositoryInterface $staffRepository;

    public function __construct(StaffRepositoryInterface $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }

    public function index()
    {
        $staffs = $this->staffRepository->getAll([
            'user',
        ]);

        return StaffResource::collection($staffs);
    }
}
