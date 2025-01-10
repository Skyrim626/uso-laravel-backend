<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends BaseResource
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
            'position_id' => $this->position_id,
            'position' => $this->position->name,
            'user_id' => $this->user_id,
            'name' => $this->getFullName(
                $this->user->first_name ?? "",
                $this->user->middle_name ?? "",
                $this->user->last_name ?? "",
            ),
            'photo_url' => $this->photo_url,
            'cor_url' => $this->cor_url,
            'grades_url' => $this->grades_url,
            'moral_url' => $this->moral_url,
            'certificate_url' => $this->certificate_url,
            'pds_url' => $this->pds_url,
            'facebook_link' => $this->facebook_link,
        ];
    }
}
