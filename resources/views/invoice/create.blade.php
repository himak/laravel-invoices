@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('New invoice') }}</div>
        <div class="card-body">
            @if($customers)
                <form action="{{ route('invoices.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="invoice_number">{{ __('Number') }} *</label>
                    <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ old('invoice_number') }}" placeholder="{{ __('e.g. INV20210001') }}">
                </div>
                <div class="form-group">
                    <label for="due_date">{{ __('Due date') }} *</label>
                    <input type="text" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}" placeholder="dd.mm.yyyy">
                </div>
                <div class="form-group">
                    <label for="customer_id" class="d-flex justify-content-between">{{ __('Customer') }} *<a href="{{ route('customers.create') }}">{{ __('new customer') }}</a></label>
                    <select class="custom-select @error('customer_id') is-invalid @enderror" name="customer_id">
                        <option disabled>select customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->business_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="items" class="d-flex justify-content-between">{{ __('Items') }} *<a href="{{ route('items.create') }}">{{ __('new item') }}</a></label>
                    <select class="custom-select @error('items') is-invalid @enderror" name="items[]" multiple>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name . ' : ' . $item->price . '€' }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            @else
                <p class="mb-0"><strong class="text-danger">{{ __('Missing customer.') }}</strong> <a href="{{ route('customers.create') }}">{{ __('Add customer') }}</a></p>
            @endif
        </div>
    </div>

@endsection

