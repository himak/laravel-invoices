<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();

        $customers = $user->customers()
            ->paginate(10);

        return view('customer.index', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $user->customers()->create($request->validated());

        return redirect()->route('customers.index')
            ->with('success', __('Customer saved successfully.'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('customer.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): RedirectResponse
    {
        abort_if(Gate::denies('update', $customer), 403);

        return redirect()->route('customers.edit', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View
    {
        abort_if(Gate::denies('update', $customer), 403);

        return view('customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        abort_if(Gate::denies('update', $customer), 403);

        $customer->update($request->validated());

        return redirect()->route('customers.edit', $customer)
            ->with([
                'customer' => $customer,
                'success' => __('Customer updated successfully.'),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        abort_if(Gate::denies('update', $customer), 403);

        $customer->delete();

        return redirect()->route('customers.index')
            ->with('danger', __('Customer has been deleted!'));
    }
}
