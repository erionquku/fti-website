<?php

global $dbConnection;

$dbConnection = new mysqli(
    "localhost",
    "root",
    "",
    "web_project");

function execute_query($query)
{
    global $dbConnection;
    return $dbConnection->query($query);
}