<?php

namespace App\Http\Requests\Offer;

use App\Models\Category;
use App\Models\Offer;
use App\Traits\failedValidationApiTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOfferRequest extends FormRequest
{
    use failedValidationApiTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('create-offers');
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
                Rule::unique(Offer::class)
            ],
            'details' => [
                'sometimes',
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
            'category_id' => [
                'required',
                Rule::exists(Category::class, 'id')
            ],
            'start_date' => [
                'required',
                'date',
                'before:end_date'
            ],
            'end_date' => [
                'required',
                'date',
                'after::start_date'
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
