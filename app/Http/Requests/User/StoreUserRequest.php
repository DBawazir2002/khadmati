<?php

namespace App\Http\Requests\User;

use App\Enums\MobilePrefix;
use App\Models\User;
use App\Traits\failedValidationApiTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    use failedValidationApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('create-users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'digits:9',
                 Rule::unique(User::class),
                'starts_with:' . implode(",", MobilePrefix::values())
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'image' => [
                'sometimes',
                'required',
                'file',
                'mimes:png,jpg,jpeg',
                'mimetypes:image/jpeg,image/png',
                'max:2048'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'اسم',
            'phone' => 'هاتف',
            'address' => 'عنوان',
            'image' => 'صورة'
        ];
    }
}
