<?php

namespace App\Services;

use App\Interfaces\Category\ICategoryRepository;
use App\Interfaces\Category\ICategoryService;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryService implements ICategoryService
{

    private ICategoryRepository $repository;
    /**
     * Create a new class instance.
     */
    public function __construct(ICategoryRepository $repository)
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
        $category = $this->repository->store($data);
        $category->addMediaFromRequest('image')->toMediaCollection('image');
        return $category;
    }

    public function update(string $id, array $data)
    {
        $category = $this->repository->update($id, $data);
        $category->addMediaFromRequest('image')->toMediaCollection('image');
        if(request()->hasFile('image')){
            $category->addMediaFromRequest('image')->toMediaCollection('image');
        }
        return $category;
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
