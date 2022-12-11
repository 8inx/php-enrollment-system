<?php


function  connection()
{

    $config = include(__DIR__ . '/../config.php');

    $hostname = $config['hostname'];
    $username = $config['username'];
    $password = $config['password'];
    $database = $config['database'];

    $conn = new mysqli($hostname, $username, $password, $database);

    if (mysqli_connect_errno()) {
        header("HTTP/1.1 500 Internal Server Error");
        die(json_encode(array('message' => 'Internal Server Error')));
    }

    return $conn;
}
