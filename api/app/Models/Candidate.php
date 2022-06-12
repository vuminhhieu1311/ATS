<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Candidate extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'resume_url',
        'status',
        'user_id',
        'is_star',
        'updated_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'current_job',
    ];

    protected function currentJob(): Attribute
    {
        $jobId = optional($this->application)->job_id;
        $job = $this->jobs->firstWhere('id', $jobId);

        return new Attribute(
            get: fn () => $job,
        );
    }

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

    public function resumes()
    {
        return $this->hasMany(Resume::class);
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

    public function stages()
    {
        return $this->belongsToMany(Stage::class, 'candidate_jobs')
            ->as('application')
            ->withPivot('id', 'job_id', 'rejection_id');
    }

    public function currentCandidateJob()
    {
        return $this->hasOne(CandidateJob::class)
            ->where('is_active', true);
    }
}
