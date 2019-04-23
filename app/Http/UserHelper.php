<?php
namespace App\Http;

use App\User;
use App\Http\Config;
use GuzzleHttp;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;

class UserHelper 
{
	private static $instance;

	private function __construct() {
	}

	public static function getInstance() {
		if ($this->instance == null) {
			$this->instance = new UserHelper();
		}

		return $this->instance;
	}

	public static function updateUserStatus(User $user, $status, $expiry_time = 0) {
        if ($user->gdv_id) {
            $data = [];
            
            $data['secret_key'] = Config::getSecretKey();           
            $data['gdv_id'] = $user->gdv_id;
            $data['availability'] = $user->getAvailability();
            $data['status'] = $status;
            $data['expiry_time'] = $expiry_time;

            try {
                $client = new Client();            

                $response = $client->post(config('app.api_4x') . 'updateGdvStatus', [
                    'form_params' => $data
                ]);                
            } catch (RequestException $e) {                
                return response()->json(['result' => false, 'message' => $e->getMessage()]);
            }

            return $response->getBody();
        }

        return response()->json(['result' => false]);
    }

    public static function setStatus(User $user, $availability) {
    	$expire = config('session.lifetime') * 60;
    	Redis::SET("users:" . $user->id, $availability);
    	Redis::EXPIRE("users:" . $user->id, $expire);
    }
}

?>