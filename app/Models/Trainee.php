<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    use HasFactory;
    protected $fillable = ['roll_number','first_name','last_name','father_name','dob','doj','gender','user_id','tazikra_number','tazikra_photo_url','marital_status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
