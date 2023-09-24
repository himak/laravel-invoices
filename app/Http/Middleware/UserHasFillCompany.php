<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class UserHasFillCompany
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->business_name && !Auth::user()->identification_code) {
            session()->flash('info', __('First step, please enter your billing information') . '. <strong><a href="'. route('profile.show') .'">Settings</a></strong>' . '.');
        }

        return $next($request);
    }
}
