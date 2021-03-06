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
            ->with('customers', Customer::all(['id','business_name', 'identification_code'])
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

        $customer = new Customer();

        $customer->business_name = $request->business_name;
        $customer->identification_code = $request->identification_code;

        $customer->save();

        session()->flash('success', 'Customer saved successfully.');

        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $request->validated();

        $customer = Customer::findOrFail($request->customer_id);

        $customer->business_name = $request->business_name;
        $customer->identification_code = $request->identification_code;

        $customer->save();

        session()->flash('success', 'Customer details changed successfully.');

        return view('customer.edit')->with('customer', $customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id);

        session()->flash('danger', 'Customer has been deleted!');

        return redirect('/customers');
    }
}
