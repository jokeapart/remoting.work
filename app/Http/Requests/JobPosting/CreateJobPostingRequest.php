<?php

namespace App\Http\Requests\JobPosting;

use Illuminate\Foundation\Http\FormRequest;

class CreateJobPostingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'employer_id' => ['required', 'integer'],
			'title' => ['required', 'string'],
			'description' => ['required', 'string'],
			'skills_required' => ['required', 'string'],
			'requirements' => ['required', 'string'],
			'application_status' => ['required', 'string'],
        ];
    }
}
