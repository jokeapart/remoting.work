<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer'],
			'bpo_name' => ['required', 'string'],
			'profile_image' => ['required', 'image'],
			'office_image' => ['required', 'image'],
        ];
    }
}
