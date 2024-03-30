<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provence extends Model
{
    use HasFactory;
    protected $fillable = ['provenance_name'];
}
