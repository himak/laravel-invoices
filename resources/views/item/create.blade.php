@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('New item') }}</div>
        <div class="card-body">
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="price">Price *</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

@endsection

