@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('items.create') }}" class="btn btn-primary">{{ __('Add item') }}</a>
    </div>

    <div class="card">
        <div class="card-header">{{ __('Items') }}</div>
        <div class="card-body">
            @if(count($items))
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col" class="col-8">Name</th>
                    <th scope="col" class="col-2 text-right">Price</th>
                    <th scope="col" class="col-2"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td class="text-right text-nowrap">{{ $item->price }} €</td>
                        <td >
                            <div class="d-flex justify-content-end">
                                @can('update', $item)
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-link btn-sm py-0">detail</a>
                                    {{--                            <form action="{{ route('items.destroy', $item->id) }}" method="POST">--}}
                                    {{--                                @csrf--}}
                                    {{--                                @method('DELETE')--}}
                                    {{--                                <button type="submit" class="btn btn-link text-danger py-0 px-1">x</button>--}}
                                    {{--                            </form>--}}
                                    <button type="button" class="btn btn-link btn-sm text-danger py-0 px-1" data-toggle="modal" onclick="handleDelete({{ $item->id }})">x</button>
                                @else
                                    <small class="text-danger">{{ __('not allowed') }}</small>
                                    <button type="button" class="btn btn-link btn-sm text-danger py-0 px-1" data-toggle="modal" onclick="handleDelete({{ $item->id }})">x</button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <p class="mb-0">You haven't created an invoice yet. <a href="{{ route('items.create') }}">Create item</a></p>
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

            form.action = '/items/' + id

            $('#deleteModal').modal('show')
        }
    </script>
@endsection


