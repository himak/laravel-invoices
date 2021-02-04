<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class UserHasFillCompany
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->business_name || !Auth::user()->identification_code) {
            session()->flash('info', 'First step, please enter your billing information' . '. <strong><a href="'. route('company.show') .'">Settings</a></strong>' . '.');
            return redirect('/company');
        }

        return $next($request);
    }
}
