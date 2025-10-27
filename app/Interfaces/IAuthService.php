<?php

namespace App\Interfaces;

interface IAuthService
{
    public function login(string $phone, string $password, bool $remember = false): void;

    public function logout(): void;
}
