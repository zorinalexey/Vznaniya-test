<?php

namespace App\Http\Requests\Api\V1\Users;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'surname' => 'string|nullable',
            'name' => 'string|nullable',
            'middlename' => 'string|nullable',
            'birth_date' => 'date|nullable',
            'city' => 'string|nullable',
            'email' => 'string|nullable',
            'password' => 'string|nullable',
        ];
    }
}
