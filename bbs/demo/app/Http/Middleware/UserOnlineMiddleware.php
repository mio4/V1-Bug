<?php

namespace App\Http\Middleware;

use App\DataEntity\User;
use Closure;

class UserOnlineMiddleware
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
        $uid = session()->get('uid');
        if(is_null($uid))
        {
            $errorMessage = [
                'msg' => [
                    '请登录'
                ]
            ];
            return redirect('usr/sign-in')
                ->withErrors($errorMessage);
        }
        return $next($request);
    }
}
