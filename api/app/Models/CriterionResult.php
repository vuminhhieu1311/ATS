<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterionResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'score',
        'note',
        'interview_staff_id',
        'criterion_id',
    ];

    public function criterion()
    {
        return $this->belongsTo(Criterion::class);
    }

    public function interviewStaff()
    {
        return $this->belongsTo(InterviewStaff::class);
    }
}
