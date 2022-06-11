<?php

namespace App\Http\Controllers;

use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Repositories\Candidate\CandidateRepositoryInterface;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    protected CandidateRepositoryInterface $candidateRepository;

    public function __construct(CandidateRepositoryInterface $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

    public function index(Request $request)
    {
        $queries = $request->query();
        $candidates = $this->candidateRepository->queryAllByConditions($queries, [
            'user',
        ]);

        return CandidateResource::collection($candidates);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Candidate $candidate)
    {
        //
    }

    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    public function destroy(Candidate $candidate)
    {
        //
    }
}
