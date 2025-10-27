<?php

namespace App\Repositories;

use App\Interfaces\IBaseRepository;

class BaseRepository implements IBaseRepository
{

    protected $model;
    public function setModel($model): void
    {
        $this->model = $model;
    }

    public function makeInstanceOfModel()
    {
        return app($this->model);
    }
}
