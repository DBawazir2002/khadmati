<?php

namespace App\Repositories;

use App\Interfaces\Offer\IOfferRepository;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OfferRepository extends BaseRepository implements IOfferRepository
{

    public function index(array $data): LengthAwarePaginator|null|Collection
    {
        $query = $this->makeInstanceOfModel()->query();

        return $query->paginate();
    }

    public function count(): int
    {
        return $this->makeInstanceOfModel()->query()->count();
    }

    public function find(string $column, string $value): Model
    {
        return $this->makeInstanceOfModel()->query()->where($column, $value)->firstOrFail();
    }

    public function store(array $data): Model
    {
        return $this->makeInstanceOfModel()->query()->create($data);
    }

    public function update(string $id, array $data): Model
    {
        $offer = $this->find('id', $id);
        $offer->update($data);
        return $offer->refresh();
    }

    public function delete(string $id): void
    {
        $offer = $this->find('id', $id);
        $offer->delete();
    }

    public function list(array $data): Collection|array|null
    {
        $offers = collect();

        $query = $this->makeInstanceOfModel()->query();

        $query->chunk(500, function ($chunk) use (&$offers) {
            foreach ($chunk as $offer) {
                $offers->push($offer);
            }
        });

        return $offers;
    }
}
