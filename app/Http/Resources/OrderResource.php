<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends BaseResource
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
            'user_id' => $this->user_id,
            'name' => $this->user ? $this->getFullName(
                $this->user->first_name,
                $this->user->middle_name,
                $this->user->last_name,
            ) : null,
            'status' => ucfirst($this->status),
            'created_at' => $this->created_at,
        ];
    }
}
