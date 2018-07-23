<?php

namespace App\Http\Middleware;

use Closure;
use Validator;

class DoctorAccount
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
                    'userName'=>'required|min:3',
                    'profession'=>'required|min:3',
                    'name'=>'required|min:3',
                    'lastName'=>'required|min:3',
                    'country'=>'required|min:3',
                ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            return $next($request);
        }else
            return $next($request);
    }
}
