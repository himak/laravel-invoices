<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Customer $customer */
        $customer = $this->resource;

        return [
            'id' => $customer->getAttribute('id'),
            'business_name' => $customer->getAttribute('business_name'),
            'identification_code' => $customer->getAttribute('identification_code'),
        ];
    }
}
