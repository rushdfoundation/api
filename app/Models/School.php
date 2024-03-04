<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','location'];

    public function activities(){
        return $this->hasMany(Activity::class);
    }
    public function Addresses(){
        return $this->hasMany(Address::class);
    }
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function assessments(){
        return $this->hasMany(Assessment::class);
    }
    public function assessmentSubmitions(){
        return $this->hasMany(AssessmentSubmission::class);
    }
    public function attendences(){
        return $this->hasMany(Attendance::class);
    }
    public function classrooms(){
        return $this->hasMany(Classroom::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function courses(){
        return $this->hasMany(Course::class);
    }
    public function courseTypes(){
        return $this->hasMany(CourseType::class);
    }
    public function educations(){
        return $this->hasMany(Education::class);
    }
    public function exams(){
        return $this->hasMany(Exam::class);
    }
    public function examResults(){
        return $this->hasMany(ExamResult::class);
    }
    public function examTypes(){
        return $this->hasMany(ExamType::class);
    }
    public function experiences(){
        return $this->hasMany(Experience::class);
    }
    public function guardians(){
        return $this->hasMany(Guardian::class);
    }
    public function homeworks(){
        return $this->hasMany(Homework::class);
    }
    public function homeworkSubmissions(){
        return $this->hasMany(HomeworkSubmission::class);
    }
    public function lectures(){
        return $this->hasMany(Lecture::class);
    }
    public function libraries(){
        return $this->hasMany(Library::class);
    }
    public function noticeboards(){
        return $this->hasMany(Noticboard::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function questionTypes(){
        return $this->hasMany(QuestionType::class);
    }
    public function relatives(){
        return $this->hasMany(Relative::class);
    }
    public function roles(){
        return $this->hasMany(Role::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function subjects(){
        return $this->hasMany(Subject::class);
    }
    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
    public function timetables(){
        return $this->hasMany(Timetable::class);
    }
    public function trainees(){
        return $this->hasMany(Trainee::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
