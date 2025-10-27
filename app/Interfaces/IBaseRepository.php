<?php

namespace App\Interfaces;

interface IBaseRepository
{
    public function setModel($model): void;

    public function makeInstanceOfModel();
}
