<?php

namespace App\Http\Middleware;

use Closure;
use Validator;

class RegisterMiddlevare
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
        $input = $request->except('_token');
        $validator = Validator::make($input,
            [
                'name' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'user_name' => 'required|string|min:3',
                'country' => 'required|string|max:255',
                'password' => 'required|string|min:5|confirmed',
                'password_confirmation' => 'required_with:password|same:password|min:5',
                'profession' => 'required|string|max:255',
            ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        return $next($request);
    }
}
