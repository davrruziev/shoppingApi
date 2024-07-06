<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user,
            'comment' => $this->comment,
            'delivery_method_id' => $this->delivery_method,
            'payment_type_id' => $this->payment_type,
            'status_id' => $this->status,
            'sum' => $this->sum,
            'products' => $this->products,
            'address' => $this->address,

        ];
    }
}
