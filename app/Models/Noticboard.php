<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticboard extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','link','school_id'];
}
