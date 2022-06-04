<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'company']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customer.index')
            ->with('customers', \Auth::user()->customers()->get(['id','user_id','business_name', 'identification_code'])
            ->sortBy('business_name'));
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
        $request->validated();

        auth()->user()->customers()->create($request->validated());

        session()->flash('success', 'Customer saved successfully.');

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

        session()->flash('success', 'Customer details changed successfully.');

        return view('customer.edit')->with('customer', $customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('update', $customer);

        \Auth::user()->customers()->findOrFail($customer->id)->delete();

        session()->flash('danger', 'Customer has been deleted!');

        return redirect('/customers');
    }
}
