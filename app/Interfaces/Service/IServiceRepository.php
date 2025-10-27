<?php

namespace App\Interfaces\Service;

use App\Interfaces\IBaseCrudRepository;
use Illuminate\Support\Collection;

interface IServiceRepository extends IBaseCrudRepository
{
    public function list(array $data): Collection|array|null;
}
