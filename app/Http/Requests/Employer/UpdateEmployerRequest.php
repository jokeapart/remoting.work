<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'integer'],
			'bpo_name' => ['sometimes', 'string'],
			'profile_image' => ['sometimes', 'image'],
			'office_image' => ['sometimes', 'image'],
        ];
    }
}
