<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStaff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'job_id',
        'staff_id',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
