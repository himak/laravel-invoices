<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request): JsonResponse
    {
        return response()->json($request->user()
            ->only('id', 'name', 'email', 'business_name', 'identification_code')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $request->user()->update($request->validated());

        return response()->json($request->user()->toArray(), Response::HTTP_ACCEPTED);
    }
}
