<?php

use App\Exceptions\LogicException;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

function defaultPassword(): string
{
    return 'password';
}

function isFile($file): bool
{
    return $file instanceof UploadedFile;
}

function generateOtp(): int
{
    return rand(100000, 999999);
}

function defaultStartOfPhones(): string
{
    return '70,71,73,77,78';
}

function isExpire(string $date, int $hours = 1): bool
{
    return Carbon::parse($date)->addHours($hours)->isPast();
}

function isFromApi(): bool
{
    return request()->is('api/*');
}

function throttleKey(Request $request): string
{
    return Str::transliterate(Str::lower($request->string('phone')).'|'.$request->ip());
}

/**
 * @throws LogicException
 */
function ensureIsNotRateLimited(Request $request): void
{
    if (! RateLimiter::tooManyAttempts(throttleKey($request), 5)) {
        return;
    }

    event(new Lockout($request));

    $seconds = RateLimiter::availableIn(throttleKey($request));

    $message = 'عدد كبير جدا من محاولات الدخول. يرجى المحاولة مرة أخرى بعد  '. $seconds . 'ثانية.';

    if(isFromApi()) {
        throw new LogicException($message, 403);
    }else{
        throw ValidationException::withMessages([
            'form.phone' => $message,
        ]);
    }

}
