<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(User $user) {
        return view('profile.show')->with('user', Auth::user());
    }

    public function update(UpdateProfileRequest $request){

        auth()->user()->update($request->validated());

        session()->flash('success', __('Your company detail was saved.'));

        return back();
    }
}
