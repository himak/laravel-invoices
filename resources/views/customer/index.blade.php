@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('customers.create') }}" class="btn btn-primary">{{ __('Add customers') }}</a>
    </div>

    <div class="card">
        <div class="card-header">{{ __('Customers') }}</div>
        <div class="card-body">
            @if(count($customers))
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="col-6">Business name</th>
                                <th scope="col" class="col-4">ID code</th>
                                <th scope="col" class="col-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->business_name }}</td>
                                <td>{{ $customer->identification_code }}</td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        @can('update', $customer)
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-link btn-sm py-0">detail</a>
                                        <button type="button" class="btn btn-link btn-sm text-danger py-0 px-1" data-toggle="modal" onclick="handleDelete({{ $customer->id }})">x</button>
                                        @else
                                            <small class="text-danger">{{ __('not allowed') }}</small>
                                            <button type="button" class="btn btn-link btn-sm text-danger py-0 px-1" data-toggle="modal" onclick="handleDelete({{ $customer->id }})">x</button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $customers->links() }}
            @else
                <p class="mb-0">You haven't any customers. <a href="{{ route('customers.create') }}">Create a new customers</a></p>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h4>Are you sure ?</h4>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="" method="POST" class="d-inline" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onsubmit="return confirm('Do you really want to submit the form?')">Delete</button>
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

            var form = document.getElementById('deleteForm')

            form.action = '/customers/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection


