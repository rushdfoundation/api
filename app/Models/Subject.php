<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['name','image_page','classroom_id'];

    public function lectures(){
        return $this->hasMany(Lecture::class);
    }
    public function timetable()
    {
        return $this->hasMany(Timetable::class);
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
