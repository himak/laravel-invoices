<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CustomerResource::collection(Customer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCustomerRequest  $request
     *
     * @return CustomerResource
     */
    public function store(StoreCustomerRequest $request): CustomerResource
    {
        $customer = Customer::query()->create($request->validated());

        return CustomerResource::make($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  Customer  $customer
     *
     * @return CustomerResource
     */
    public function show(Customer $customer): CustomerResource
    {
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreCustomerRequest  $request
     * @param  Customer  $customer
     *
     * @return JsonResponse
     */
    public function update(StoreCustomerRequest $request, Customer $customer): JsonResponse
    {
        $customer->update($request->validated());

        return response()->json(CustomerResource::make($customer), Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Customer  $customer
     *
     * @return Response
     */
    public function destroy(Customer $customer): Response
    {
        $customer->delete();

        return response()->noContent();
    }
}
