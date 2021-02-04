@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Detail item') }}</div>
        <div class="card-body">
            <form action="{{ route('items.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="item_id" value="{{ $item->id }}">

                <div class="form-group">
                    <label for="name">{{ __('Name') }} *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $item->name) }}">
                </div>
                <div class="form-group">
                    <label for="price">{{ __('Price') }} *</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $item->price) }}">
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </form>
        </div>
    </div>

@endsection

