<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'due_date' => $this->due_date,
            'created_at' => $this->created_at,
            'total_price' => $this->total_price,
            'user' => UserResource::make($this->user),
            'customer' => CustomerResource::make($this->customer),
            'invoiceItems' => InvoiceItemsResource::collection($this->invoiceItems),
        ];
    }
}
