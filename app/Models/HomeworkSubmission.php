<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['homework_id','question_id','answer_id','given_answer','question_type'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function homework(){
        return $this->belongsTo(Homework::class);
    }
    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function answer(){
        return $this->belongsTo(Answer::class);
    }
}
