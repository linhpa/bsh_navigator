<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BshCase extends Model
{
    protected $fillable = [
    	'user_id', 'case_id', 'customer_name', 'customer_phone', 'lng1', 'lat1', 'lng2', 'lat2', 'address1', 'address2'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
