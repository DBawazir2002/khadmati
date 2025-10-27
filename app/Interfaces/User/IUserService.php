<?php

namespace App\Interfaces\User;

use App\Interfaces\IBaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IUserService extends IBaseService
{
    public function list(array $data): Collection|array|null;
    public function assignRole(string $roleName, Model $model): void;
    public function revokeRole(string $roleName, Model $model): void;
}
