<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'integer'],
			'company_name' => ['sometimes', 'string'],
        ];
    }
}
