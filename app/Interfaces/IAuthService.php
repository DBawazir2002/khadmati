<?php

namespace App\Interfaces;

interface IAuthService
{
    public function login(array $credentials): array;

    public function logout(): void;
}
