<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','marks','lecture_id'];
    
    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('mark','teacher_comment');
    }
}
