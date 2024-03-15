<?php

namespace App\Http\Resources\JobPosting;

use Illuminate\Http\Resources\Json\JsonResource;

class JobPostingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'employer_id' => $this->employer_id,
			'title' => $this->title,
			'description' => $this->description,
			'skills_required' => $this->skills_required,
			'requirements' => $this->requirements,
			'application_status' => $this->application_status,
            'created_at' => dateTimeFormat($this->created_at),
            'updated_at' => dateTimeFormat($this->updated_at),
        ];
    }
}
