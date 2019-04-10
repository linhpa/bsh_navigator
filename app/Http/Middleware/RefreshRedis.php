<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Redis;

class RefreshRedis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //refreshing the expiration of users key
        if(Auth::check()){
            $id = Auth::user()->id;
            $expire = config('session.lifetime') * 60;
            if (Redis::GET('users:' . $id == NULL)) {
                Redis::SET('users:' . $id, 1);                
            }
            Redis::EXPIRE('users:' . $id, $expire);
            
        }
        return $next($request);
    }
}
