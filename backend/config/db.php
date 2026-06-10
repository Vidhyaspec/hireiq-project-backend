<?php

$host = getenv("DB_HOST") ?: "127.0.0.1";
$user = getenv("DB_USER") ?: "root";
$pass = getenv("DB_PASS") ?: "";
$name = getenv("DB_NAME") ?: "hireiq";
$port = getenv("DB_PORT") ?: 3306;

$conn = new mysqli($host, $user, $pass, $name, $port);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed: " . $conn->connect_error
    ]));
}

?>