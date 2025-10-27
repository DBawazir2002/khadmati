<?php

namespace App\Services;

use App\Enums\Role as RoleEnum;
use App\Interfaces\User\IUserRepository;
use App\Interfaces\User\IUserService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserService implements IUserService
{
    private IUserRepository $repository;
    /**
     * Create a new class instance.
     */
    public function __construct(IUserRepository $repository)
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

    public function find(string $column, string $value): Model
    {
        return $this->repository->find($column, $value);
    }

    public function store(array $data): Model
    {
        $user = $this->repository->store($data);
        if(request()->has('image')) {
            $user->addMediaFromRequest('image');
        }
        return $user;
    }

    public function update(string $id, array $data): Model
    {
        $user = $this->repository->update($id, $data);
        if(request()->has('image')) {
            $user->addMediaFromRequest('image');
        }
        return $user;
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

    public function list(array $data): Collection|array|null
    {
        return $this->repository->list($data);
    }


    public function assignRole(string $roleName, Model $model): void
    {
        match (!$model->hasRole($roleName) and RoleEnum::findFrom($roleName)) {
            true => $model->assignRole($roleName)
        };
    }

    public function revokeRole(string $roleName, Model $model): void
    {
        match ($model->hasRole($roleName) and RoleEnum::findFrom($roleName)) {
            true => $model->removeRole($roleName)
        };
    }
}
