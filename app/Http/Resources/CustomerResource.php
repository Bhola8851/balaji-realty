<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'customer_contact' => $this->customer_contact,
            'customer_email' => $this->customer_email,
            'customer_address' => $this->customer_address,
            'customer_description' => $this->customer_description,
            'materials' => route('materials.index', $this->id)

        ];
    }
}
