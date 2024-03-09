<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    use HasFactory;
    protected $fillable = ['name','school_id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'type_id');
    }
}
