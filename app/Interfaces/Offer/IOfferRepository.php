<?php

namespace App\Interfaces\Offer;

use App\Interfaces\IBaseCrudRepository;
use Illuminate\Support\Collection;

interface IOfferRepository extends IBaseCrudRepository
{
    public function list(array $data): Collection|array|null;
}
