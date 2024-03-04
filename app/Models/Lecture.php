<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','image_path','file_path','subject_id','course_id'];
    
    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function assessment()
    {
        return $this->hasOne(Assessment::class);
    }
    public function homework()
    {
        return $this->hasOne(Homework::class);
    }
  
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
