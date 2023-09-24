@if ($errors->any())
    <div class="container mt-4">
        <div class="alert alert-danger">
            <ul class="mb-0 pl-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (session('status'))
    <div class="container mt-4">
        <div class="alert alert-info mb-0 alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('info'))
    <div class="container mt-4">
        <div class="alert alert-info mb-0 alert-dismissible fade show" role="alert">
            {!! session('info') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="container mt-4">
        <div class="alert alert-success mb-0 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('danger'))
    <div class="container mt-4">
        <div class="alert alert-danger mb-0 alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
