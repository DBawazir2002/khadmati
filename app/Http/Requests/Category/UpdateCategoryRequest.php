<?php

namespace App\Http\Requests\Category;

use App\Traits\failedValidationApiTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    use failedValidationApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('edit-categories');
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
                Rule::unique('categories')
                    ->ignore($this->id)
            ],
            'icon' => [
                'sometimes',
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'اسم',
            'description' => 'وصف',
            'icon' => 'ايقونة'
        ];
    }
}
