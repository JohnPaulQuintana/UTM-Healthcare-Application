<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSchedules extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'schedule_id','details', 'status', 'date', 'time'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
