<?php

namespace App\Http\Resources\Candidate;

use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
			'subscription_type' => $this->subscription_type,
			'verified_status' => $this->verified_status,
			'bpo_id' => $this->bpo_id,
			'profile_image' => $this->profile_image,
			'resume' => $this->resume,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
