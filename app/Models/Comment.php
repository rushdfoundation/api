<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment_text','user_id','lecture_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}
