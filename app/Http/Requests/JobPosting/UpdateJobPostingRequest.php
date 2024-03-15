<?php

namespace App\Http\Requests\JobPosting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobPostingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'employer_id' => ['sometimes', 'integer'],
			'title' => ['sometimes', 'string'],
			'description' => ['sometimes', 'string'],
			'skills_required' => ['sometimes', 'string'],
			'requirements' => ['sometimes', 'string'],
			'application_status' => ['sometimes', 'string'],
        ];
    }
}
