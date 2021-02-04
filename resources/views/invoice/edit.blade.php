@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Detail faktúry') }}</div>
        <div class="card-body">
            <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="invoice_number">Číslo faktúry *</label>
                    <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ old('invoice_number', $invoice->invoice_number) }}" placeholder="napr. FA20200123">
                </div>
                <div class="form-group">
                    <label for="due_date">Dátum splatnosti *</label>
                    <input type="text" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date', $invoice->due_date) }}" placeholder="XX.XX.XXXX">
                </div>
                <div class="form-group">
                    <label for="customer_id">Zákazník *</label>
                    <select class="custom-select @error('customer_id') is-invalid @enderror" name="customer_id">
                        <option disabled>-</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $customer->id == $invoice->customer->id ? 'selected' : '' }}>{{ $customer->business_name }}</option>
                        @endforeach
                    </select>
                </div>

                <fieldset>
                    <legend>Položky *</legend>
                    @foreach($invoice->invoiceItems as $item)
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Nazov</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('due_date', $item->name) }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="price">Cena</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('due_date', $item->price) }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </fieldset>

                <div class="form-group">
                    <label for="items" class="d-flex justify-content-between">Položka *<a href="{{ route('items.create') }}">nová položka</a></label>
                    <select class="custom-select @error('items') is-invalid @enderror" name="items[]" multiple>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name . ' : ' . $item->price }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection

