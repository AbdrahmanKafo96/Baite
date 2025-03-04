<?php

namespace App\Http\Resources;

use App\Models\myServiceLevelTow;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_details'=>myServiceLevelTow::whereIn('id' ,$this->service_seclected)->get(),
            'id'=>$this->id,
            'order_number'=>$this->order_number,
            'note'=>$this->note,
            'status'=>$this->status,
            'phone_number'=>$this->phone_number,
            'total_price'=>$this->total_price,
            'user_id'=>$this->user_id,
        ];
    }
}
