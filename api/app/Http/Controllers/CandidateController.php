<?php

namespace App\Http\Controllers;

use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Repositories\Candidate\CandidateRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $candidate->load('user', 'education', 'experiences');

        return CandidateResource::make($candidate);
    }

    public function update(Request $request, Candidate $candidate)
    {
        try {
            DB::beginTransaction();
            $candidate->user()->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phoneNumber'),
                'gender' => $request->input('gender'),
                'birthday' => $request->input('birthday'),
                'address' => $request->input('address'),
            ]);

            $candidate->update([
                'description' => $request->input('description'),
            ]);
            DB::commit();

            $candidate->load('user', 'education', 'experiences');

            return CandidateResource::make($candidate);
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
    }

    public function destroy(Candidate $candidate)
    {
        //
    }
}
