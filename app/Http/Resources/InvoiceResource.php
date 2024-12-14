<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //        return parent::toArray($request);

        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'due_date' => $this->due_date,
            'total_price' => $this->total_price,
            'user' => UserResource::make($this->user),
            'customer' => CustomerResource::make($this->customer),
            'invoiceItems' => InvoiceItemsResource::collection($this->invoiceItems),
        ];
    }
}
