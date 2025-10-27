<?php

namespace App\Jobs;

use App\Models\PasswordResetOtp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class sendOtp implements ShouldQueue
{
    use Queueable;

    protected $phone;

    protected $otp;
    protected $expireIn;

    /**
     * Create a new job instance.
     */
    public function __construct($phone, $otp, $expireIn)
    {
        $this->phone = $phone;
        $this->otp = $otp;
        $this->expireIn = $expireIn;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $expiresAt = now()->addMinutes($this->expireIn);
        PasswordResetOtp::updateOrCreate(
            ['phone' => $this->phone],
            ['otp' => $this->otp, 'expires_at' => $expiresAt]
        );
    }
}
