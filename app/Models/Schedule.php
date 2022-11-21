<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id', 'starting_time', 'end_time', 'day', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
