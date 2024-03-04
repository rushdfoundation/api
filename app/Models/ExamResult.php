<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'student_id', 'teacher_id','subject_id','course_id', 'mark','teacher_comments'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
