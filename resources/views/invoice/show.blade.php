@extends('layouts.print')

@section('content')

    <div class="btn-print d-print-none">
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('invoices.index') }}" class="btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>
                Back
            </a>
            <button class="btn btn-outline-primary" onclick="window.print();">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
                </svg>
                Print
            </button>
        </div>
    </div>

    <div class="page">
        <div class="subpage">
            <div class="header mb-5">
                <div class="d-flex justify-content-between mb-5">
                    <div class="col">
                        <h6 class="mt-0 mb-1 text-muted">Invoice number</h6>
                        <p class="mb-0"><strong>{{ $invoice->invoice_number }}</strong></p>
                    </div>
                    <div class="col text-right">
                        <h6 class="mt-0 mb-1 text-muted">Due date</h6>
                        <p class="mb-0">{{ $invoice->due_date }}</p>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="col">
                        <h6 class="mt-0 mb-2 text-muted">Company</h6>
                        <p class="mb-0"><strong>{{ Auth::user()->getAttribute('business_name') }}</strong></p>
                        <p class="mb-0">Street number 1</p>
                        <p class="mb-0">Town</p>
                        <p class="mb-0">ZIP</p>
                        <p class="mb-3">Country</p>
                        <p class="mb-0"><span class="text-muted">ID code:</span> {{ Auth::user()->getAttribute('identification_code') }}</p>
                    </div>
                    <div class="col text-right">
                        <h6 class="mt-0 mb-2 text-muted">Customers</h6>
                        <p class="mb-0"><strong>{{ $invoice->customer->business_name }}</strong></p>
                        <p class="mb-0">Street number 1</p>
                        <p class="mb-0">Town</p>
                        <p class="mb-0">ZIP</p>
                        <p class="mb-3">Country</p>
                        @isset($invoice->customer->identification_code)<p class="mb-0"><span class="text-muted">ID code:</span> {{ $invoice->customer->identification_code }}</p>@endisset
                    </div>
                </div>
            </div>

            <div class="body pt-5">
                <table class="table">
                    <caption class="sr-only">Items</caption>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-right">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoice->invoiceItems as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td class="text-right">{{ $item->price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2" class="text-right">
                            <div class="price">
                                <h5 class="font-weight-bold mt-3"><span class="mr-5">Total price:</span> {{ $invoice->total_price }}</h5>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <div class="footer bg-primary">
                <div class="d-flex justify-content-between">
                    <div class="text-white">
                        <p class="text-white-50 mt-3">Invoice number</p>
                        <h4>{{ $invoice->due_date }}</h4>
                    </div>
                    <div class="text-white text-right">
                        <p class="text-white-50 mt-3">Total price</p>
                        <h4>{{ $invoice->total_price }}</h4>
                    </div>
                </div>
                <div class="text-center mb-2">
                    <small class="text-white-50">Created by <a href="http://www.onlineinvoices.eu" target="_blank" class="text-white">www.onlineinvoices.eu</a></small>
                </div>
            </div>
        </div>
    </div>


@endsection
