<?php

namespace App\Interfaces\Category;

use App\Interfaces\IBaseService;
use Illuminate\Support\Collection;

interface ICategoryService extends IBaseService
{
    public function list(array $data): Collection|array|null;

}
