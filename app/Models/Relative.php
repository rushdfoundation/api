<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    use HasFactory;
    protected $fillable = ['id','brother','kaka','mama','pesar_kaka','pesar_mama','student_id','school_id'];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
