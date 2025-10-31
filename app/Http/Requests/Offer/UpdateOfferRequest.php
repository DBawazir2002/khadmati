<?php

namespace App\Http\Requests\Offer;

use App\Models\Category;
use App\Models\Offer;
use App\Traits\failedValidationApiTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOfferRequest extends FormRequest
{
    use failedValidationApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('edit-offers');
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
                Rule::unique(Offer::class)
                    ->ignore($this->id)
            ],
            'details' => [
                'sometimes',
                'required',
                'string'
            ],
            'image' => [
                'sometimes',
                'required',
                'file',
                'mimes:png,jpg,jpeg',
                'mimetypes:image/jpeg,image/png',
                'max:2048'
            ],
            'category_id' => [
                'sometimes',
                'required',
                Rule::exists(Category::class, 'id')
            ],
            'start_date' => [
                'sometimes',
                'required',
                'date',
                'before:end_date'
            ],
            'end_date' => [
                'sometimes',
                'required',
                'date',
                'after:start_date'
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'اسم',
            'details' => 'تفاصيل',
            'image' => 'صورة',
            'category_id' => 'تصنيف',
            'start_date' => 'تاريخ البدء',
            'end_date' => 'تاريخ النهاية',
        ];
    }
}
