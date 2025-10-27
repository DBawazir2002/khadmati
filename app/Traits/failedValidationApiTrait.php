<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait failedValidationApiTrait
{
    public static function withValidator(Validator $validator): void
    {
        if ($validator->fails()) {
            throw new HttpResponseException(
                sendFailedResponse(
                    __('messages.validation_error'),
                    collect($validator->errors())->map(fn ($value, $key) => $value[0]),
                    422
                )
            );
        }
    }
}
