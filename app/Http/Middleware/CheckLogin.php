<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        //执行动作
        //根据session值判断用户是否登录
        $user=session('user');
        if(!$user){
            return redirect('/login');
        }
        return $next($request);
    }
}
