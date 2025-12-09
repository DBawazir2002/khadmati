<?php

namespace App\Services;

use App\Interfaces\Offer\IOfferRepository;
use App\Interfaces\Offer\IOfferService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OfferService implements IOfferService
{

    private IOfferRepository $repository;
    /**
     * Create a new class instance.
     */
    public function __construct(IOfferRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(array $data): LengthAwarePaginator|null|Collection
    {
        return $this->repository->index($data);
    }

    public function count(): int
    {
        return $this->repository->count();
    }

    public function find(string $column, string $value)
    {
        return $this->repository->find($column, $value);
    }

    public function store(array $data)
    {
        $offer = $this->repository->store($data);
        if(request()->hasFile('image')){
            $offer->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return $offer;
    }

    public function update(string $id, array $data)
    {
        $offer = $this->repository->update($id, $data);
        if(request()->hasFile('image')){
            $offer->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return $offer;
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

    public function list(array $data): Collection|array|null
    {
        return $this->repository->list($data);
    }
}
