<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use App\Traits\failedValidationApiTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
{
    use failedValidationApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('create-categories');
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
                Rule::unique(Category::class)
            ],
            'description' => [
                'required',
                'string'
            ],
            'image' => [
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
            'description' => 'وصف',
            'image' => 'صورة',
        ];
    }
}
