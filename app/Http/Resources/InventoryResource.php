<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "image_url" => $this->images 
                ? $this->images->firstWhere('isMain', 1)->image_url ?? null
                : null,
            'name' => $this->name,
            'category' => $this->category->name,
            'size' => $this->size,
            'color' => $this->color,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'organization' => $this->organization->name,
            'updated_at' => $this->formatDateOnlyDate($this->updated_at),
            'description' => $this->description,
        ];
    }
}
