<?php

namespace App\Services;

use App\Exceptions\LogicException;
use App\Interfaces\IPasswordResetService;
use App\Interfaces\User\IUserService;
use App\Jobs\sendOtp;
use App\Models\PasswordResetOtp;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ResetPasswordService implements IPasswordResetService
{

    private IUserService $userService;
    /**
     * Create a new class instance.
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws LogicException
     */
    public function send(string $phone): bool
    {
        ensureIsNotRateLimited(request());

        if (! $user = $this->userService->find('phone', $phone)) {
            RateLimiter::hit(throttleKey(request()));

            throw ValidationException::withMessages([
                'phone' => ' رقم الجوال أو كلمة المرور غير صحيحة',
            ]);
        }

        RateLimiter::clear(throttleKey(request()));

        $otp = generateOtp();
        $expireIn = (int)config('app.otp_life_in_minutes');
        $is_exists = $this->isOtpActiveAndExists($phone);
        if (!$is_exists) {
            dispatch(new sendOtp($phone, $otp, $expireIn));
            return true;
        }
        return false;
    }

    public function verify(string $phone, string $otp): bool
    {
        $is_verified = false;
        $userOtpRecord = PasswordResetOtp::query()
            ->where('is_verified', false)
            ->where('phone', $phone)
            ->where('otp', $otp)
            ->first();
        if (!empty($userOtpRecord) && now()->lt($userOtpRecord->expires_at)) {
            $is_verified = true;
            $userOtpRecord->update(['is_verified' => $is_verified]);
        }
        return $is_verified;
    }

    public function update($phone, $otp, $password): bool
    {
        $user = $this->userService->find('phone', $phone);
        $userOtpRecord = PasswordResetOtp::query()->where('phone', $user->phone)->where('otp', $otp)->firstOrFail();

        if (now()->gt($userOtpRecord->expires_at)) {
            return false;
        }

        $user->forceFill([
            'password' => $password
        ]);

        $user->save();

        $userOtpRecord->delete();

        return true;
    }

    private function isOtpActiveAndExists(string $phone): bool
    {
        return PasswordResetOtp::query()->where('phone', $phone)->where('expires_at', '>', now())->exists();
    }
}
