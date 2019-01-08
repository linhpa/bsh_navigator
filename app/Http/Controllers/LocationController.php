<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use JWTAuth;
use JWTAuthException;
use Hash;

class LocationController extends Controller
{
	protected $location;

	public function __construct(Location $location) {
		$this->location = $location;
	}

    public function getLocation(Request $request) {    	
    	$locations = Location::where('phone', $request->input('phone'))->get();

        return response()->json(['result' => $locations]);
    }

    public function postLocation(Request $request) {
    	$result = $this->location->create([
    		'phone' => $request->input('phone'),
	    	'gdv' => $request->input('gdv'),
	    	'lat' => $request->input('lat'),
	    	'lng' => $request->input('lng'),
    	]);
    	
    	return response()->json(['result' => $result]);
    }
}
