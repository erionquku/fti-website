<?php

namespace Core\Repositories\Classes;

use App\Models\User\User;
use Core\Models\BaseModel;
use Core\Repositories\Contracts\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    abstract public function model(): string;

    abstract public function table_name(): string;

    abstract public function primary_key(): string;

    abstract public function columns(): array;

    public function __construct()
    {
        $this->model = $this->model();
        $this->table_name = $this->table_name();
        $this->primary_key = $this->primary_key();
    }

    public function find(int $id): BaseModel
    {
        $model = new $this->model;
        $result = execute_query(
            "SELECT * FROM `$this->table_name`
                WHERE `$this->primary_key` = '$id' 
                LIMIT 1")
            ->fetch_assoc();

        if ($result != false)
            foreach ($result as $key => $value) {
                $model->$key = $value;
            }
        return $model;
    }

    public function countBy($column, $value): int
    {
        if (!is_int($value)) {
            $value = "'" . $value . "'";
        }
        $result = execute_query("SELECT count(*) FROM $this->table_name WHERE $column = $value")->fetch_assoc();
        return $result["count(*)"];
    }


    public function countAll(): int
    {
        $result = execute_query("SELECT count(*) FROM $this->table_name")->fetch_assoc();
        return $result["count(*)"];
    }

    public function findBy($column, $value)
    {
        $model = new $this->model;
        $value = quote_value($value);
        $result = execute_query("SELECT * FROM `$this->table_name` WHERE `$column` = $value")
            ->fetch_assoc();

        if (!empty($result))
            foreach ($result as $key => $value) {
                $model->$key = $value;
            }
        else
            return false;

        return $model;
    }

    public function findAllBy($column, $value): array
    {
        $collection = [];
        $query = "SELECT * FROM $this->table_name WHERE `$column` = '$value'";
        $results = execute_query($query);
        foreach ($results as $result) {
            $model = new $this->model;
            foreach ($result as $key => $value) {
                $model->$key = $value;
            }
            $collection[] = $model;
        }
        return $collection;
    }

    public function findAllByData($data): array
    {
        $collection = [];

        if ($data) {
            $keys = array_keys($data);
            $query = "SELECT * FROM $this->table_name WHERE ";
            foreach ($data as $key => $value) {
                $query .= "`$key` = " . quote_value($value);
                if (end($keys) != $key) {
                    $query .= " AND ";
                }
            }
            $results = execute_query($query);

            foreach ($results as $result) {
                $model = new $this->model;
                foreach ($result as $key => $value) {
                    $model->$key = $value;
                }
                $collection[] = $model;
            }
        }

        return $collection;
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    public function update(array $data, $id): bool
    {
        $query = "UPDATE $this->table_name SET ";

        $first = true;
        foreach ($data as $key => $value) {
            !$first ? $query .= ", " : $first = false;
            $query .= "$key = " . quote_value($value);
        }
        $query .= " WHERE $this->primary_key = $id";

        return execute_query($query);
    }

    public function store(array $data): bool
    {
//        $keys = array();
//        $values = array();
//        foreach ($this->columns() as $column) {
//            $value = trim($data[$column]);
//            if (!is_int($value)) {
//                $value = escape_string($value);
//                $values[] = "'{$value}'";
//            } else {
//                $values[] = $value;
//            }
//            $keys[] = "`{$column}`";
//
//        }
//
//        $query = "INSERT INTO " . $this->table_name . " (" . implode(",", $keys) . ")
//          VALUES (" . implode(",", $values) . ");";
//
//        return execute_query($query);

        $query = "INSERT INTO $this->table_name (" .
            implode(", ", array_keys($data)) . ") 
            VALUES (" . implode(", ", escape_strings_from_array(array_values($data))) . ")";
        return execute_query($query);
    }

    public function all(): array
    {
        $collection = [];
        $results = execute_query("SELECT * FROM " . $this->table_name());
//        dd($results);
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