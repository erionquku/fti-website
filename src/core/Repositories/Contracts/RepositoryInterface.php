<?php

namespace Core\Repositories\Contracts;

use Core\Models\BaseModel;

interface RepositoryInterface
{
    public function find(int $id) : BaseModel;

    public function findBy($key, $value);

    public function countBy($key, $value) : int;

    public function delete(int $id) : bool;

    public function update(array $data, $id) : bool;

    public function store(array $data) : bool;

    public function all(): array;
}