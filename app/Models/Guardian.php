<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;
    protected $fillable = ['first_name','last_name','gender','job','dob','user_id','child_refrence_id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
