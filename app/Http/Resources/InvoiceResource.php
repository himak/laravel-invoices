<?php

namespace App\Http\Resources;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        /** @var Invoice $invoice */
        $invoice = $this->resource;

        return [
            'id' => $invoice->getAttribute('id'),
            'invoice_number' => $invoice->getAttribute('invoice_number'),
            'due_date' => $invoice->getAttribute('due_date'),
            'created_at' => $invoice->getAttribute('created_at'),
            'total_price' => $invoice->getAttribute('total_price'),
            'user' => UserResource::make($invoice->getAttribute('user')),
            'customer' => CustomerResource::make($invoice->getAttribute('customer')),
            'invoiceItems' => InvoiceItemsResource::collection($invoice->getAttribute('invoiceItems')),
        ];
    }
}
