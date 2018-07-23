<?php

namespace App\Http\Middleware;

use Closure;
use Validator;

class DoctorAnswer
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
        if($request->isMethod('post'))
        {
            $input = $request->except('_token');
            $validator = Validator::make($input,
                [
                    'text'=>'required',
                ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            return $next($request);
        }else
        return $next($request);
    }
}
