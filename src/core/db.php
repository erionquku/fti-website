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

function escape_string($string)
{
    global $db_connection;
    return $db_connection->escape_string($string);
}