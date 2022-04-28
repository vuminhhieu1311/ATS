<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\CandidateJob;
use Illuminate\Database\Seeder;

class CandidateJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CandidateJob::truncate();

        $candidates = Candidate::all();

        foreach($candidates as $candidate) {
            CandidateJob::create([
                'candidate_id' => $candidate->id,
                'job_id' => 1,
                'stage_id' => random_int(1, 6),
            ]);
        }
    }
}
