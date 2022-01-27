<?php

namespace App\Repository\Contracts;

abstract class Repository implements RepositoryInterface
{

    protected $model;

    public function getModel()
    {
        return $this->model;
    }

    public function create(array $data)
    {
        return $this->model::insert($data);
    }

    public function findBy($field, $value)
    {
        return $this->model::where($field, '=', $value)->first();
    }

    public function where($field, $value)
    {
        return $this->model::where($field, '=', $value);
    }
}