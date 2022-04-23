<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'job_id',
        'tag_id',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
