@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('New customer') }}</div>
        <div class="card-body">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="business_name">Business name *</label>
                    <input type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{ old('business_name') }}">
                </div>
                <div class="form-group">
                    <label for="identification_code">ID code</label>
                    <input type="text" class="form-control @error('identification_code') is-invalid @enderror" name="identification_code" value="{{ old('identification_code') }}">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection

