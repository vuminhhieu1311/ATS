<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'note',
        'is_online',
        'link',
        'status',
        'candidate_job_id',
        'mail_template_id',
        'room_id',
    ];

    public function candidateJob()
    {
        return $this->belongsTo(CandidateJob::class);
    }

    public function mailTemplate()
    {
        return $this->belongsTo(MailTemplate::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
