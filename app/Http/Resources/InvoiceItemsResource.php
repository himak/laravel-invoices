<?php

namespace App\Http\Resources;

use App\Models\InvoiceItem;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        /** @var InvoiceItem $invoiceItem */
        $invoiceItem = $this->resource;

        return [
            'id' => $invoiceItem->getAttribute('id'),
            'name' => $invoiceItem->getAttribute('name'),
            'price' => $invoiceItem->getAttribute('price'),
        ];
    }
}
