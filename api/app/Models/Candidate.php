<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'description',
        'profile_photo_url',
        'resume_url',
        'status',
        'user_id',
    ];

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function socialProfiles()
    {
        return $this->hasMany(SocialProfile::class);
    }

    public function candidateStaffs()
    {
        return $this->hasMany(CandidateStaff::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'candidate_jobs');
    }

    public function candidateJobs()
    {
        return $this->hasMany(CandidateJob::class);
    }

    public function interviews()
    {
        return $this->hasManyThrough(Interview::class, CandidateJob::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
