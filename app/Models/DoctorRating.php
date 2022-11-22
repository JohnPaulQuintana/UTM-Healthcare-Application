<?php

namespace App\Models;

use App\Http\Resources\SchedulesResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorRating extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'doctor_id', 'feedback', 'ratings'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
        // return $this->belongsTo(Schedule::class);
    }
    // public function ratings()
    // {
    //     return $this->belongsTo(Schedule::class);
    // }
}
