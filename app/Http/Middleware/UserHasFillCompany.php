<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class UserHasFillCompany
{
    public function handle(Request $request, Closure $next)
    {
        /* @var User $user */
        $user = auth()->user();

        if (! $user->getAttribute('business_name') && ! $user->getAttribute('identification_code')) {
            return redirect()->route('profile.show')
                ->with('info', __('Please enter your billing information.'));
        }

        return $next($request);
    }
}
