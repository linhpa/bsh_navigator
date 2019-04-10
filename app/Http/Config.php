<?php
namespace App\Http;

use \DB;

class Config {
	public function __construct() {

	}

	public static function getSecretKey() {
		$config = DB::table('config')->where('key', '=', 'secret_key')->first();

        return $config->value;
	}
}
?>