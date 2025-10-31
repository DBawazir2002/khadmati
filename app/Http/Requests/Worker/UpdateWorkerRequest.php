<?php

namespace App\Http\Requests\Worker;

use App\Enums\MobilePrefix;
use App\Models\User;
use App\Traits\failedValidationApiTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkerRequest extends FormRequest
{
    use failedValidationApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('edit-users');
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
                'sometimes',
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'sometimes',
                'required',
                'string',
                'digits:9',
                Rule::unique(User::class)
                    ->ignore($this->id),
                'starts_with:' . implode(",", MobilePrefix::values())
            ],
            'address' => [
                'sometimes',
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
            'services' => [
                'sometimes',
                'required',
                'array'
            ],
            'services.*' => [
                'required_with:services',
                'exists:services,id'
            ],
            'services_details' => [
                'sometimes',
                'required',
                'array'
            ],
            'services_details.*' => [
                'required_with:services_details',
                'string'
            ]
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
