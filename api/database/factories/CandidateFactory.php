<?php

namespace Database\Factories;

use App\Enums\Candidate\CandidateStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'description' => $this->faker->paragraph(),
            'resume_url' => $this->faker->url(),
            'status' => CandidateStatus::NEW,
        ];
    }
}
