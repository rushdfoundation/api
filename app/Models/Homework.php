<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $table = 'homeworks';
    protected $fillable = ['title','description','deadline','mark','lecture_id'];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_homework')->withPivot('mark','teacher_comment');
    }
}
