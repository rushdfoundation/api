<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = ['position','organization','organization_location','from','to','tasks','user_id'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
