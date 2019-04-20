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
                'status' => 401,
                'message' => '请登录'
            ];
            return redirect()->to('html/sign-page.html');
            // return response()->json($errorMessage);
        }
        return $next($request);
    }
}
