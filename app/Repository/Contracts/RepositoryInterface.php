<?php

namespace App\Repository\Contracts;

interface RepositoryInterface
{
    public function getModel();
    public function create(array $data);
    public function findBy($field, $value);
    public function where($field, $value);
}