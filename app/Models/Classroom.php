<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = ['name','room'];

    public function students(){
        return $this->belongsToMany(Student::class,'classroom_student');
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class);
    }

    public function timetable()
    {
        return $this->hasMany(Timetable::class);
    }

    public function subjects(){
        return $this->hasMany(Subject::class);
    }
}
