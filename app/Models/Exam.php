<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['name','description', 'date', 'type_id'];

    public function types()
    {
        return $this->hasMany(ExamType::class,'type_id');
    }
    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_exam');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'results', 'exam_id', 'teacher_id');
    }

    public function questions(){
        return $this->belongsToMany(Question::class);
    }
}
