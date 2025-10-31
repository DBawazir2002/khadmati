<?php

namespace App\Http\Requests\Service;

use App\Models\Category;
use App\Models\Service;
use App\Traits\failedValidationApiTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceRequest extends FormRequest
{
    use failedValidationApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('create-services');
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
                Rule::unique(Service::class)
            ],
            'category_id' => [
                'required',
                Rule::exists(Category::class, 'id')
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
            'category_id' => 'تصنيف',
            'image' => 'صورة'
        ];
    }
}
