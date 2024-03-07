<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'integer'],
			'subscription_type' => ['sometimes', 'string'],
			'verified_status' => ['sometimes', 'string'],
			'bpo_id' => ['sometimes', 'integer'],
			'profile_image' => ['sometimes', 'image'],
			'resume' => ['sometimes', 'string'],
        ];
    }
}
