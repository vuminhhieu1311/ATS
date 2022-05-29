<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resume extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'candidate_id',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function template()
    {
        return $this->belongsTo(ResumeTemplate::class, 'template_id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($resume) {
            if (empty($resume->uuid)) {
                $resume->uuid = Str::uuid();
            }
        });
    }
}
