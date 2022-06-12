<?php

namespace App\Models\Traits;

trait UpdateCandidate
{
    protected static function booted()
    {
        parent::booted();

        static::created(function ($model) {
            if ($model->candidate) {
                $model->candidate->update([
                    'updated_at' => now(),
                ]);
            }
        });

        static::updated(function ($model) {
            logger('Hello');
            if ($model->candidate) {
                $model->candidate->update([
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
