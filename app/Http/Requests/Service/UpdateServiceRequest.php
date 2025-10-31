<?php

namespace App\Http\Requests\Service;

use App\Models\Category;
use App\Models\Service;
use App\Traits\failedValidationApiTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    use failedValidationApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('edit-services');
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
                Rule::unique(Service::class)
            ],
            'category_id' => [
                'sometimes',
                'required',
                Rule::exists(Category::class, 'id')
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
            'category_id' => 'تصنيف',
            'image' => 'صورة'
        ];
    }
}
