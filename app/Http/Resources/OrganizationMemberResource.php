<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationMemberResource extends BaseResource
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
            "first_name" => $this->first_name,
            "middle_name" => $this->middle_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "address" => $this->address,
            "name" => $this->getFullName(
                $this->first_name,
                $this->middle_name,
                $this->last_name,
            ),
           "course" => $this->course?->name,
        "status" => ucfirst($this->pivot->status),
        "facebook_link_url" => $this->facebook_link_url,
        ];

      
    }
}
