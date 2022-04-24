<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Job extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country',
        'city',
        'employment_type',
        'description',
        'requirements',
        'benefit',
        'min_offer',
        'max_offer',
        'currency',
        'deadline',
        'photo_url',
        'status',
        'pipeline_id',
        'user_id',
    ];

    /**
     * Get the user's first name.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function deadline(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d/m/Y'),
        );
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_jobs');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'job_tags');
    }

    public function pipeline()
    {
        return $this->belongsTo(Pipeline::class);
    }

    public function candidateJobs()
    {
        return $this->hasMany(CandidateJob::class);
    }

    public function interviews()
    {
        return $this->hasManyThrough(Interview::class, CandidateJob::class);
    }

    // Creator of the job
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
