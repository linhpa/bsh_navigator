<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\mAuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use mAuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated()
    {
        $user = Auth::user();

        $expire = config('session.lifetime') * 60;

        // Setting redis using id as namespace and value
        $id = $user->id;
        Redis::SET('users:' . $id, 1);
        Redis::EXPIRE('users:' . $id, $expire);

        return redirect('/home');
    }

    //@override
    public function logout(Request $request)
    {
        // Deleting user from redis database when they log out
        $id = Auth::user()->id;
        Redis::DEL('users:'.$id);

        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }
}
