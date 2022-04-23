<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewStaff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'interview_id',
        'staff_id',
    ];

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
