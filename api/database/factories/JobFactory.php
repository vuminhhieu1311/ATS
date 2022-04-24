<?php

namespace Database\Factories;

use App\Enums\Job\EmploymentType;
use App\Enums\Job\JobStatus;
use App\Enums\Job\OfferCurrency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle(),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'employment_type' => $this->faker->randomElement(EmploymentType::ALL_TYPE),
            'description' => $this->faker->paragraph(),
            'requirement' => $this->faker->paragraph(),
            'benefit' => $this->faker->paragraph(),
            'min_offer' => $this->faker->randomNumber(7, true),
            'max_offer' => $this->faker->randomNumber(8, true),
            'currency' => OfferCurrency::VND,
            'deadline' => $this->faker->date(),
            'photo_url' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(JobStatus::ALL_STATUS),
            'pipeline_id' => 1,
        ];
    }
}
