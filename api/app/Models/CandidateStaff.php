<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateStaff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'candidate_id',
        'staff_id',
        'type',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}