<?php

namespace Database\Seeders;

use App\Models\Pipeline;
use App\Models\PipelineStage;
use App\Models\Stage;
use Illuminate\Database\Seeder;

class PipelineStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pipeline::truncate();
        Stage::truncate();
        PipelineStage::truncate();

        Pipeline::create([
            'name' => 'Default pipeline',
        ]);

        $stages = [
            [
                'name' => 'Applied',
                'type' => 'applied',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Feedback',
                'type' => 'feedback',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Interviewing',
                'type' => 'interviewing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Made Offer',
                'type' => 'offer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Disqualified',
                'type' => 'disqualified',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hired',
                'type' => 'hired',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Stage::insert($stages);

        $pipelineStages = [
            [
                'pipeline_id' => 1,
                'stage_id' => 1,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pipeline_id' => 1,
                'stage_id' => 2,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pipeline_id' => 1,
                'stage_id' => 3,
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pipeline_id' => 1,
                'stage_id' => 4,
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pipeline_id' => 1,
                'stage_id' => 5,
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pipeline_id' => 1,
                'stage_id' => 6,
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        PipelineStage::insert($pipelineStages);
    }
}
