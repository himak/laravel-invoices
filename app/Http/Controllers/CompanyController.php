<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(User $user) {
        return view('company.show')->with('user', Auth::user());
    }

    public function store(StoreCompanyRequest $request){

        $request->validated();

        $user = User::find(Auth::id());

        $user->business_name = $request->business_name;
        $user->identification_code = $request->identification_code;

        $user->save();

        session()->flash('success', 'Your company detail was saved.');

        return back();
    }
}
