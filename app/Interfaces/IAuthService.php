<?php

namespace App\Interfaces;

interface IAuthService
{
    public function login(string $phone, string $password, bool $remember = false): string;

    public function logout(): void;
}
