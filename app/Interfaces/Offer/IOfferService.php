<?php

namespace App\Interfaces\Offer;

use App\Interfaces\IBaseService;
use Illuminate\Support\Collection;

interface IOfferService extends IBaseService
{
    public function list(array $data): Collection|array|null;

}
