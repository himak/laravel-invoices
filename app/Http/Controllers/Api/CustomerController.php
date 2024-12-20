<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        /* @var User $user */
        $user = Auth::user();

        return CustomerResource::collection($user->getAttribute('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): CustomerResource
    {
        $customer = Customer::query()->create($request->validated());

        return CustomerResource::make($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): CustomerResource
    {
        abort_if(Gate::denies('update', $customer), 403);

        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCustomerRequest $request, Customer $customer): JsonResponse
    {
        abort_if(Gate::denies('update', $customer), 403);

        $customer->update($request->validated());

        return response()->json(CustomerResource::make($customer), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): Response
    {
        abort_if(Gate::denies('update', $customer), 403);

        $customer->delete();

        return response()->noContent();
    }
}
