@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('invoices.create') }}" class="btn btn-primary">{{ __('New invoice') }}</a>
    </div>

    <div class="card">
        <div class="card-header">{{ __('Invoices') }}</div>
        <div class="card-body">
            @if(count($invoices))
                <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Price</th>
                    <th scope="col">Date</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->invoice_number }}</td>
                        <td><a href="{{ route('customers.edit', $invoice->customer->id) }}">{{ $invoice->customer->business_name }}</a></td>
                        <td>{{ $invoice->total_price }} €</td>
                        <td>{{ $invoice->created_at->diffForHumans()  }}</td>
                        <td class="d-flex justify-content-end">
                            <a href="{{ route('invoice.print', $invoice->id) }}" class="btn btn-link py-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                </svg>
                                <span class="sr-only">{{ __('Print') }}</span>
                            </a>
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-link py-0">view</a>
                            <button type="button" class="btn btn-link text-danger py-0 px-1" data-toggle="modal" onclick="handleDelete({{ $invoice->id }})">x</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                    <form action="" method="POST" class="d-inline" id="deleteProjectForm">
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

            var form = document.getElementById('deleteProjectForm')

            form.action = '/invoices/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection


