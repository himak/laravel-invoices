<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $customers = $user->customers()
            ->paginate(10);

        return view('customer.index')
            ->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        auth()->user()->customers()->create($request->validated());

        session()->flash('success', __('Customer saved successfully.'));

        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $this->authorize('update', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $this->authorize('update', $customer);

        return view('customer.edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $customer = Customer::updateOrCreate(
            ['id' => $request->customer_id],
            $request->validated()
        );

        session()->flash('success', __('Customer details changed successfully.'));

        return view('customer.edit')
            ->with('customer', $customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('update', $customer);

        \Auth::user()->customers()->findOrFail($customer->id)->delete();

        session()->flash('danger', __('Customer has been deleted!'));

        return redirect(route('customers.index'));
    }
}
