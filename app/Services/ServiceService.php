<?php

namespace App\Services;

use App\Interfaces\Service\IServiceRepository;
use App\Interfaces\Service\IServiceService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ServiceService implements IServiceService
{

    private IServiceRepository $repository;
    /**
     * Create a new class instance.
     */
    public function __construct(IServiceRepository $repository)
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
        $service = $this->repository->store($data);
        $service->addMediaFromRequest('image')->toMediaCollection('image');
        return $service;
    }

    public function update(string $id, array $data)
    {
        $service = $this->repository->update($id, $data);
        $service->addMediaFromRequest('image')->toMediaCollection('image');
        return $service;
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
