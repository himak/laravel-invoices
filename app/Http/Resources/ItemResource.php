<?php

namespace App\Http\Resources;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        /** @var Item $item */
        $item = $this->resource;

        return [
            'id' => $item->getAttribute('id'),
            'name' => $item->getAttribute('name'),
            'price' => $item->getAttribute('price'),
        ];
    }
}
