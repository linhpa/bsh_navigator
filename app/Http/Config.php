<?php
namespace App\Http;

use \DB;

class Config {
	public function __construct() {

	}

	public static function getSecretKey() {
		$config = DB::table('config')->get();

        return $config[0]->secret_key;
	}
}
?>