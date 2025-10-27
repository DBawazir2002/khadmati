<?php

namespace App\Interfaces;

interface IPasswordResetService
{
    public function send(string $phone): bool;

    public function verify(string $phone, string $otp): bool;

    public function update($phone, $otp, $password): bool;
}
