<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Repositories\Tag\TagRepositoryInterface;
use Illuminate\Http\Request;

class GetAllTagController extends Controller
{
    protected TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function __invoke(Request $request)
    {
        $conditions = [
            ['name', 'like', '%' . $request->query('keyword') . '%'],
        ];
        $tags = $this->tagRepository->queryAllByConditions($conditions);

        return TagResource::collection($tags);
    }
}
