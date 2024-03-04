<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = "educations";
    protected $fillable = ['level','location','graduation_year','center','user_id'];
    
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
   
}
