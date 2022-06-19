<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
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

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'criterion_questions');
    }

    public function criterionResults()
    {
        return $this->hasMany(CriterionResult::class);
    }

    public function criterionQuestions()
    {
        return $this->hasMany(CriterionQuestion::class);
    }
}
