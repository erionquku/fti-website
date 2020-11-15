<?php

namespace Core\Repositories\Classes;

use Core\Models\BaseModel;
use Core\Repositories\Contracts\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    abstract public function model(): string;

    abstract public function table_name(): string;

    abstract public function primary_key(): string;

    public function __construct()
    {
        $this->model = $this->model();
        $this->table_name = $this->table_name();
        $this->primary_key = $this->primary_key();
    }

    public function find(int $id): BaseModel
    {
        $model = new $this->model;
        $result = execute_query("SELECT * FROM $this->table_name WHERE $this->primary_key = $id LIMIT 1")->fetch_assoc();
        foreach ($result as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }

    public function findBy($column, $value)
    {

    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    public function update(array $data, $id): bool
    {
        // TODO: Implement update() method.
    }

    public function store(array $data): bool
    {
        // TODO: Implement store() method.
    }

    public function all(): array
    {
        $collection = [];
        $results = execute_query("SELECT * FROM $this->table_name");
        foreach ($results as $result) {
            $model = new $this->model;
            foreach ($result as $key => $value) {
                $model->$key = $value;
            }
            $collection[] = $model;
        }
        return $collection;
    }
}