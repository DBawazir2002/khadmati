<?php

namespace App\Interfaces\Category;

use App\Interfaces\IBaseCrudRepository;
use Illuminate\Support\Collection;

interface ICategoryRepository extends IBaseCrudRepository
{
    public function list(array $data): Collection|array|null;
}
