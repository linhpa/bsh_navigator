<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BshCase extends Model
{
    protected $fillable = [
    	'user_id', 'case_id', 'customer_name', 'customer_phone', 'lng1', 'lat1', 'lng2', 'lat2', 'address1', 'address2', 'case_time', 'case_location', 'driver_info', 'case_detail_info', 'damage_level', 'done_jobs', 'note', 'status', 'description'
    ];

    protected $nullable = [
    	'user_id', 'case_id', 'customer_name', 'lng1', 'lat1', 'lng2', 'lat2', 'address1', 'address2', 'case_time', 'case_location', 'driver_info', 'case_detail_info', 'damage_level', 'done_jobs', 'note', 'status', 'description'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
