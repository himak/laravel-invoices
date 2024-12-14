@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">{{ __('New invoice') }}</a>
    </div>

    <div class="card">
        <div class="card-header">{{ __('Invoices') }}</div>
        <div class="card-body">
            @if(count($invoices))
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-2">Number</th>
                                <th class="col-4">Customer</th>
                                <th class="col-2">Price</th>
                                <th class="col-2">Date</th>
                                <th class="col-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                @can('update', $invoice)
                                    <td>{{ $invoice->user_id }}</td>
                                    <td class="text-nowrap"><a href="{{ route('customers.edit', $invoice->customer->id) }}">{{ $invoice->customer->business_name }}</a></td>
                                    <td class="text-nowrap">{{ $invoice->total_price }} €</td>
                                    <td class="text-nowrap">{{ $invoice->created_at->diffForHumans()  }}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-link py-0">view</a>
                                        <button type="button" class="btn btn-link text-danger py-0 px-1" data-toggle="modal" onclick="handleDelete({{ $invoice->id }})">x</button>
                                    </td>
                                @else
                                    <td colspan="5" class="text-center">
                                        <small class="text-danger">{{ __('not allowed') }}</small>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mb-0">You haven't created an invoice yet. <a href="{{ route('invoices.create') }}">Create invoice</a></p>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h4>{{ __('Are you sure') }}?</h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <form action="" method="POST" class="d-inline" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onsubmit="return confirm('Do you really want to submit the form?')">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function handleDelete(id) {

            console.log('deleting.', id)

            const form = document.getElementById('deleteForm')

            form.action = '/invoices/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection


