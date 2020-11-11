<?php

namespace Models;

abstract class DbTable
{
    const TABLE_NAME = null;
    const PRIMARY_KEY = null;

    /**
     * @var \mysqli
     */

    protected $columns = [];

    /**
     * Builds a SQL query to insert into the database
     *
     * @param array $data
     * @return string
     */
    private function buildInsertQuery(array $data)
    {
        $c = get_called_class();
        $table_name = $c::TABLE_NAME;
        $query = "INSERT INTO $table_name \n(";
        foreach (array_keys($data) as $column) {
            $query .= "`" . $this->escape_string($column) . "`,";
        }
        $query = substr($query, 0, -1);
        $query .= ")\n VALUES (";
        foreach ($data as $value) {
            if (!is_int($value)) {
                $query .= "'" . $this->escape_string($value) . "',";
            } else {
                $query .= $value . ",";
            }
        }
        $query = substr($query, 0, -1);
        $query .= ");";

        return $query;
    }

    /**
     * Builds a SQL Query to update a record from the database
     *
     * @param array $data
     * @param $id
     * @return string
     */
    private function buildUpdateQuery(array $data, $id)
    {
        $table_name = self::TABLE_NAME;
        $primary_key = self::PRIMARY_KEY;

        $query = "UPDATE $table_name SET \n";
        foreach ($data as $key => $value) {
            $query .= $this->escape_string($key) . ' = ' . $this->escape_string($value) . " \n";
        }
        $query .= "WHERE $primary_key = $id; ";
        return $query;
    }

    /**
     * @param string $string
     * @return string
     */
    private function escape_string($string)
    {
        return mysqli_escape_string($this->DbConnection, $string);
    }

    /**
     * @param $query
     * @return bool | \mysqli_result
     */
    private function execute_query($query)
    {
        return $this->DbConnection->query($query);
    }

    /**
     * @return array
     */
    public function index()
    {
        $query = "SELECT * FROM " . self::TABLE_NAME;
        $result = $this->DbConnection->query($query);
        return $result->fetch_all();
    }

    /**
     * @param $data
     * @return bool
     */
    public function store($data)
    {
        $query = $this->buildInsertQuery($data);
        return $this->execute_query($query);
    }

    /**
     * @return bool
     */
    public function destroy()
    {
        $class = get_called_class();
        $table_name = $class::TABLE_NAME;
        $primary_key = $class::PRIMARY_KEY;
        $id = $this->$primary_key;

        $query = "DELETE FROM $table_name where $primary_key = $id;";
        var_dump($query);
        return $this->execute_query($query);
    }

    /**
     * @param $id
     */
    public function get($id)
    {
        $c = get_called_class();
        $table_name = $c::TABLE_NAME;
        $primary_key = $c::PRIMARY_KEY;

        $query = "SELECT * FROM $table_name where `$primary_key` = $id";

        $result = $this->DbConnection->query($query)->fetch_assoc();

        foreach ($result as $column => $value) {
            $this->$column = $result[$column];
        }

    }

}