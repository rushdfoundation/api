<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provence extends Model
{
    use HasFactory;
       protected $table = 'provence';
       protected $primaryKey = 'id';
       protected $fillable = ['provence_name'];
}
