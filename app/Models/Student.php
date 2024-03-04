<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','father_name','grand_father_name','dob','doj','gender','user_id','tazikra_number','tazkira_photo_url','guardian_refrence_id','marital_status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class, 'guardian_reference_id');
    }
    public function classrooms(){
        return $this->belongsToMany(Classroom::class,'classroom_student');
    }

    public function relative(){
        return $this->hasOne(Relative::class);
    }
  
}
