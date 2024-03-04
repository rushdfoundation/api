<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','father_name','gender','dob','doj','job','tazkira_number','tazkira_photo_url','marital_status','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
   
    public function subjects(){
        return $this->hasMany(Subject::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'trainer_id');
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }
    
    public function timetable()
    {
        return $this->hasMany(Timetable::class);
    }
}
