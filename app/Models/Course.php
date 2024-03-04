<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type_id', 'description', 'image_path', 'trainer_id'];

    public function types()
    {
        return $this->hasMany(CourseType::class,'type_id');
    }
    public function lectures(){
        return $this->hasMany(Lecture::class,'lecture_id');
    }

    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('status');
    }

    public function trainer()
    {
        return $this->belongsTo(Teacher::class, 'trainer_id');
    }

}
