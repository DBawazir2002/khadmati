<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IBaseService
{
    public function index(array $data): LengthAwarePaginator|null|Collection;

    public function find(string $column, string $value);

    public function store(array $data);

    public function update(string $id, array $data);

    public function delete(string $id): void;

    public function count(): int;


}
