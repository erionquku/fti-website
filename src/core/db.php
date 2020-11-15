<?php

global $db_connection;

$db_config = [
    'host' => 'localhost',
    'username' => 'root',
    'passwd' => '',
    'dbname' => 'web_project'
];

$db_connection = new mysqli(
    $db_config['host'],
    $db_config['username'],
    $db_config['passwd'],
    $db_config['dbname']
);

function execute_query($query)
{
    global $db_connection;
    return $db_connection->query($query);
}

if (!function_exists('escape_string')) {
    function escape_string($string)
    {
        global $db_connection;
        return $db_connection->escape_string($string);
    }
}

function quote_value($value)
{
    if (is_int($value) or is_float($value) or is_null($value) or is_bool($value)) {
        return escape_string($value);
    }

    return "'" . escape_string($value) . "'";
}

if (!function_exists('escape_strings_from_array')) {
    function escape_strings_from_array(array $values): array
    {
        $result = [];
        foreach ($values as $value) {
            if (is_int($value) or is_float($value) or is_null($value) or is_bool($value)) {
                $result[] = escape_string($value);
            } else {
                $result[] = "'" . escape_string($value) . "'";
            }
        }
        return $result;
    }
}