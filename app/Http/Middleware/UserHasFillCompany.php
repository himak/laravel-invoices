<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserHasFillCompany
{
    public function handle(Request $request, Closure $next)
    {
        /* @var User $user */
        $user = auth()->user();

        if (! $user->getAttribute('business_name') && !$user->getAttribute('identification_code')) {
            session()->flash('info', __('First step, please enter your billing information.'));

            return Redirect::route('profile.show');
        }

        return $next($request);
    }
}
