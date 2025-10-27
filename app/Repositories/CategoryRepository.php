<?php

namespace App\Repositories;

use App\Interfaces\Category\ICategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Repositories\BaseRepository;
class CategoryRepository extends BaseRepository implements ICategoryRepository
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
        $category = $this->find('id', $id);
        $category->update($data);
        return $category->refresh();
    }

    public function delete(string $id): void
    {
        $category = $this->find('id', $id);
        $category->delete();
    }

    public function list(array $data): Collection|array|null
    {
        $categories = collect();

        $query = $this->makeInstanceOfModel()->query();

        $query->chunk(500, function ($chunk) use (&$categories) {
            foreach ($chunk as $category) {
                $categories->push($category);
            }
        });

        return $categories;
    }
}
