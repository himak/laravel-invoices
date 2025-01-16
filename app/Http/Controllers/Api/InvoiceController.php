<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use App\Models\User;
use Auth;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        /* @var User $user */
        $user = Auth::user();

        $invoices = $user->getAttribute('invoices')->load(['user', 'customer', 'invoiceItems']);

        return InvoiceResource::collection($invoices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request): InvoiceResource
    {
        // Get total price for invoice from items
        $total_price = 0;

        foreach ($request->get('items') as $item) {

            /* @var Item $findItem */
            $findItem = Item::query()->findOrFail($item);

            $total_price += $findItem->getAttributeValue('price');
        }

        $invoice = Invoice::create([
            'invoice_number' => $request->get('invoice_number'),
            'due_date' => $request->get('due_date'),
            'customer_id' => $request->get('customer_id'),
            'total_price' => $total_price,
        ]);

        foreach ($request->get('items') as $item) {

            $item_data = Item::query()->findOrFail($item)->only(['id', 'name', 'price']);

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_id' => $item_data['id'],
                'name' => $item_data['name'],
                'price' => $item_data['price'],
            ]);

        }

        return InvoiceResource::make($invoice);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): InvoiceResource
    {
        abort_if(Gate::denies('update', $invoice), 403);

        return InvoiceResource::make($invoice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice): Response
    {
        abort_if(Gate::denies('update', $invoice), 403);

        $invoice->delete();

        return response()->noContent();
    }
}
