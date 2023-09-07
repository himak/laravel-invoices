<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function show(User $user) {
        return view('company.show')->with('user', Auth::user());
    }

    public function update(UpdateCompanyRequest $request){

        auth()->user()->update($request->validated());

        session()->flash('success', __('Your company detail was saved.'));

        return back();
    }
}
