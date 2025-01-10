<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElectionResource extends BaseResource
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
            'organization_id' => $this->organization_id,
            'organization' => $this->organization->name,
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_open' => now()->between($this->start_date, $this->end_date),
            'created_at' => $this->formatDateOnlyDate($this->created_at),
            'updated_at' => $this->formatDateOnlyDate($this->updated_at),
        ];
    }
}
