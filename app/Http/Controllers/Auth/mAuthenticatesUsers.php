<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait mAuthenticatesUsers {
	use AuthenticatesUsers {
		AuthenticatesUsers::sendLoginResponse as parentSendLoginResponse;
	}

	protected function sendLoginResponse(Request $request) {
		$request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $gdv_id = Auth::user()->gdv_id;
        setcookie("gdv_id", $gdv_id, time() + 24*60*60*1000);
        setcookie("gdv_name", Auth::user()->name, time() + 24*60*60*1000);
        setcookie("gdv_phone", Auth::user()->phone, time() + 24*60*60*1000);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
	}
}

?>