<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
    	'gdv', 'phone', 'lng', 'lat'
    ];
}
