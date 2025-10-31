<?php

namespace App\Http\Requests\Auth;

use App\Traits\failedValidationApiTrait;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use failedValidationApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => [
                'required',
                'string',
                'exists:users'
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'phone' => 'الهاتف',
            'password' => ';glm hglv,v',
        ];
    }
}
