<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminLoginAjax
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
        //这里处理业务逻辑 如果通过执行下面的代码
        if(!$request->session()->has('users')){
            if($request->route()->getName() == 'admin.login.index'){
                return $next($request);
            }else{
                return response()->json([
                    'code'=>500,
                    'msg'=>'重新登陆'
                ]);
            }
        }else{
            if($request->route()->getName() == 'admin.login.index'){
                return response()->json([
                    'code'=>500,
                    'msg'=>'重新登陆'
                ]);
            }else{
                return $next($request);
            }
        }

    }
}
