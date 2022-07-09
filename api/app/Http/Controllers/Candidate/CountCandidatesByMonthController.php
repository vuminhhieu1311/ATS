<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CountCandidatesByMonthController extends Controller
{
    public function __invoke(Request $request, Candidate $candidate)
    {
        $candidates = Candidate::select('id', 'created_at')
            ->whereYear('created_at', '=', Carbon::now()->format('Y'))
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('m');
            });

        $counts = [];
        $candidateCounts = [];

        foreach ($candidates as $key => $value) {
            $counts[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($counts[$i])){
                $candidateCounts[] = $counts[$i];
            } else {
                $candidateCounts[] = 0;
            }
        }

        return $candidateCounts;
    }
}
