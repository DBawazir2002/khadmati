<?php

namespace App\Repositories;

use App\Enums\Role as RoleEnum;
use App\Interfaces\User\IUserRepository;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements IUserRepository
{

    public function index(array $data): LengthAwarePaginator|null|Collection
    {
        $query = $this->makeInstanceOfModel()->query();

        $query->when(!empty($data['role']) and RoleEnum::findFrom($data['role']), fn($q) => $q->role($data['role']));

        return $query->paginate();
    }

    public function list($data): Collection|array|null
    {
        $shops = collect();

        $query = $this->makeInstanceOfModel()->query();

        $query->when(!empty($data['role']) and RoleEnum::findFrom($data['role']), fn($q) => $q->role($data['role']));

        $query->chunk(500, function ($chunk) use (&$shops) {
            foreach ($chunk as $shop) {
                $shops->push($shop);
            }
        });

        return $shops;
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
        $user = $this->find('id', $id);
        $user->update($data);
        return $user->refresh();
    }

    public function delete(string $id): void
    {
        $user = $this->find('id', $id);
        $user->delete();
    }
}
