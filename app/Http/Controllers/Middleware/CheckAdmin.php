<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckAdmin
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
        $user = Auth::user();
        if($user) {
            if ($user->role == 'admin') {
                return $next($request);
            } else {
                return redirect()->route('loginUser');
            }
        }else{
            return redirect()->route('main');
        }
    }
}
