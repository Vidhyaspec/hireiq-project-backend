<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "hireiq";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("DB Connection Failed: " . $conn->connect_error);
}

?>