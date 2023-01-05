<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    
    use HasFactory;
    protected $fillable = ['emergency_description', 'student_Id', 'doctor_Id', 'status','latitude','longitude','student_Name','doctor_Name'];
}
