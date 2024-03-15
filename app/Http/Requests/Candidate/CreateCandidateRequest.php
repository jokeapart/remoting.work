<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CreateCandidateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
			'subscription_type' => ['required', 'string'],
			'verified_status' => ['required', 'string'],
			'bpo_id' => ['required', 'integer'],
			'profile_image' => ['required', 'image'],
			'resume' => ['required', 'string'],
        ];
    }
}
