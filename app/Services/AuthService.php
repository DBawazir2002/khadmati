<?php

namespace App\Services;

use App\Exceptions\LogicException;
use App\Interfaces\IAuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthService implements IAuthService
{

    /**
     * @throws LogicException
     */
    public function login(string $phone, string $password, bool $remember = false): string
    {
        ensureIsNotRateLimited(request());

        if (! Auth::attempt(['phone' => $phone, 'password' => $password], $remember)) {
            RateLimiter::hit(throttleKey(request()));

            throw ValidationException::withMessages([
                'phone' => ' رقم الجوال أو كلمة المرور غير صحيحة',
            ]);
        }

        if(!Auth::user()->is_active) {
            $this->logout();
            throw ValidationException::withMessages([
                'phone' => 'هذا الحساب تم توقيف نشاطه',
            ]);
        }

        RateLimiter::clear(throttleKey(request()));

        return auth()->user()->createToken('user-accessible')->plainTextToken;
    }

    public function logout(): void
    {
        auth()->user()->tokens()->delete();
    }
}
