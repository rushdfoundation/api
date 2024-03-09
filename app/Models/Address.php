<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable=['country','province','city','district','street','street_number','lane','house','zip','formatted_address','school_id'];
   
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
