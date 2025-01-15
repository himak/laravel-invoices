<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        /** @var User $user */
        $user = $this->resource;

        return [
            'id' => $user->getAttribute('id'),
            'business_name' => $user->getAttribute('business_name'),
            'identification_code' => $user->getAttribute('identification_code'),
            'email' => $user->getAttribute('email'),
        ];
    }
}
