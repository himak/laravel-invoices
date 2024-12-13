<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        return response()->json($request->user()
            ->only('name', 'email', 'business_name', 'identification_code')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name'  => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user())],
            'business_name' => ['required', 'string'],
            'identification_code' => ['required', 'string'],
        ]);

        /* @var User $user */
        $user = auth()->user();

        $user->update($validatedData);

        return response()->json($validatedData, Response::HTTP_ACCEPTED);
    }
}
