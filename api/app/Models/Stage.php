<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'is_active',
    ];

    public function pipelines()
    {
        return $this->belongsToMany(Pipeline::class, 'pipeline_stages');
    }

    public function pipelineStages()
    {
        return $this->hasMany(PipelineStage::class);
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_jobs');
    }
}
