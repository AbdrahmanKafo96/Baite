<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

// use Illuminate\Http\Resources\Json\ResourceCollection;

// class Cart extends ResourceCollection
// {
//     /**
//      * Transform the resource collection into an array.
//      *
//      * @return array<int|string, mixed>
//      */
//     public function toArray(Request $request): array
//     {
//         return $this->service;
//     }
// }

use Illuminate\Http\Resources\Json\JsonResource;

class cart extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->service;
    }
}

