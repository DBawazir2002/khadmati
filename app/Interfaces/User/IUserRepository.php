<?php

namespace App\Interfaces\User;

use App\Interfaces\IBaseCrudRepository;
use Illuminate\Support\Collection;

interface IUserRepository extends IBaseCrudRepository
{
    public function list(array $data): Collection|array|null;
}
