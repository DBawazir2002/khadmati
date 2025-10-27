<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PasswordResetOtp extends Model
{
    use HasUuids;

    protected $fillable = ['phone', 'otp', 'expires_at', 'is_verified'];


    protected $attributes = [
        'is_verified' => false,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'is_verified' => 'boolean',
        ];
    }
}
