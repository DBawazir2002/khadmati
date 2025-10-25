<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IBaseRepository
{
    public function index(array $data): LengthAwarePaginator|null|Collection;

    public function find(string $column, string $value): Model;

    public function store(array $data): Model;

    public function update(string $column, string $value, array $data): Model;

    public function delete(string $column, string $value): Model;

    public function count(): int;


}
