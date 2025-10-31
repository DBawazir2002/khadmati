<?php

namespace App\Repositories;

use App\Interfaces\Service\IServiceRepository;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ServiceRepository extends BaseRepository implements IServiceRepository
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

    public function find(string $column, string $value)
    {
        return $this->makeInstanceOfModel()->query()->where($column, $value)->firstOrFail();
    }

    public function store(array $data)
    {
        return $this->makeInstanceOfModel()->query()->create($data);
    }

    public function update(string $id, array $data)
    {
        $service = $this->find('id', $id);
        $service->update($data);
        return $service->refresh();
    }

    public function delete(string $id): void
    {
        $service = $this->find('id', $id);
        $service->delete();
    }

    public function list(array $data): Collection|array|null
    {
        $services = collect();

        $query = $this->makeInstanceOfModel()->query();

        $query->chunk(500, function ($chunk) use (&$services) {
            foreach ($chunk as $service) {
                $services->push($service);
            }
        });

        return $services;
    }
}
