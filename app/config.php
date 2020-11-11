<?php

global $host, $db_name, $db_user, $db_pass;

$host = 'localhost';
$db_name = 'project';
$db_user = 'root';
$db_pass = "";

global $db_connection;

$db_connection = new mysqli($host, $db_user, $db_pass, $db_name);

