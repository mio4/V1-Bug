<?php

namespace App\Http\Middleware;

use App\DataEntity\User;
use Closure;

class UserAdminMiddleware
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
        // 预设值
        $isAllowAccess = false;
        $uid = session()->get('uid');
        if(!is_null($uid))
        {
            $user = User::where('uid', $uid)->findOrFail;
            // TODO 不知道认证啥
        }
        else{
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
