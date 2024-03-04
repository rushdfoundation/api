<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question_text','format','type','audio_path','classroom_id','course_id'];
  
    public function assessments()
    {
        return $this->belongsToMany(Assessment::class);
    }
    public function homeworks()
    {
        return $this->belongsToMany(Homework::class);
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
}
