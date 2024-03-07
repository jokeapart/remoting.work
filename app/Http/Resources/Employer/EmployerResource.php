<?php

namespace App\Http\Resources\Employer;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
			'bpo_name' => $this->bpo_name,
			'profile_image' => $this->profile_image,
			'office_image' => $this->office_image,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
