<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'staff_code',
        'phone_number',
        'position',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
