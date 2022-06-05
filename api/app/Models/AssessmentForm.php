<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function criteria()
    {
        return $this->belongsToMany(Criterion::class, 'assessment_criteria');
    }

    public function assessmentCriteria()
    {
        return $this->hasMany(AssessmentCriterion::class);
    }
}
