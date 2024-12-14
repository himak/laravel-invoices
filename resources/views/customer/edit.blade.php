@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Detail customer') }}</div>
        <div class="card-body">
            <form action="{{ route('customers.update', $customer) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="business_name">@lang('Business name') *</label>
                    <input type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{ old('business_name', $customer->business_name) }}">
                </div>
                <div class="form-group">
                    <label for="identification_code">@lang('ID code')</label>
                    <input type="text" class="form-control @error('identification_code') is-invalid @enderror" name="identification_code" value="{{ old('identification_code', $customer->identification_code) }}">
                </div>
                <button type="submit" class="btn btn-primary">@lang('Update')</button>
            </form>
        </div>
    </div>

@endsection

