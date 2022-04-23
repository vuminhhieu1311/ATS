<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'is_active',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function stages()
    {
        return $this->belongsToMany(Stage::class, 'pipeline_stages')
            ->withPivot('order')
            ->orderBy('pivot_order');
    }

    public function pipelineStages()
    {
        return $this->hasMany(PipelineStage::class);
    }
}
