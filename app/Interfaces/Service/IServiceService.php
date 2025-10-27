<?php

namespace App\Interfaces\Service;

use App\Interfaces\IBaseService;
use Illuminate\Support\Collection;

interface IServiceService extends IBaseService
{
    public function list(array $data): Collection|array|null;

}
