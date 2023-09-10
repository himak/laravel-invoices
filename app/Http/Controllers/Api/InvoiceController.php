<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return InvoiceResource::collection(Invoice::with('user', 'customer', 'invoiceItems')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreInvoiceRequest  $request
     *
     * @return InvoiceResource
     */
    public function store(StoreInvoiceRequest $request): InvoiceResource
    {
        // Get total price for invoice from items
        $total_price = 0;

        foreach($request->get('items') as $item) {
            $total_price += Item::query()->findOrFail($item)->getAttributeValue('price');
        }

        $invoice = Invoice::create([
            'invoice_number' => $request->get('invoice_number'),
            'due_date' => $request->get('due_date'),
            'customer_id' => $request->get('customer_id'),
            'total_price' => $total_price
        ]);

        foreach($request->get('items') as $item){

            $item_data = Item::query()->findOrFail($item)->only(['id','name','price']);

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
     *
     * @param  Invoice  $invoice
     *
     * @return InvoiceResource
     */
    public function show(Invoice $invoice): InvoiceResource
    {
        return InvoiceResource::make($invoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Invoice  $invoice
     *
     * @return Response
     */
    public function destroy(Invoice $invoice): Response
    {
        $invoice->delete();

        return response()->noContent();
    }
}
