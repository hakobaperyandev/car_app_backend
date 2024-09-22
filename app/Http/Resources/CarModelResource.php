<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,  
            'brand_id'        => $this->brand_id,  
            'price'           => $this->price,  
            'year'            => $this->year,  
            'transmission_id' => $this->transmission_id,  
            'exterior_color'  => $this->exterior_color,  
            'interior_color'  => $this->interior_color,  
            'created_at'      => $this->created_at,  
            'updated_at'      => $this->updated_at,  
            'brand'           => $this->whenLoaded('brand'),
            'engine'          => $this->whenLoaded('engine'),
            'transmission'    => $this->whenLoaded('transmission'),
        ];
    }
}
