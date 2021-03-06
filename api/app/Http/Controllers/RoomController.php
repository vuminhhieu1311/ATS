<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Repositories\Room\RoomRepositoryInterface;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected RoomRepositoryInterface $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function index()
    {
        $rooms = $this->roomRepository->getAll();

        return RoomResource::collection($rooms);
    }
}
