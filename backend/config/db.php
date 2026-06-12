<?php

$host = getenv("DB_HOST") ?: getenv("MYSQLHOST") ?: "127.0.0.1";
$user = getenv("DB_USER") ?: getenv("MYSQLUSER") ?: "root";
$pass = getenv("DB_PASS") ?: getenv("MYSQLPASSWORD") ?: "";
$name = getenv("DB_NAME") ?: getenv("MYSQLDATABASE") ?: "hireiq";
$port = getenv("DB_PORT") ?: getenv("MYSQLPORT") ?: 3306;

$conn = new mysqli($host, $user, $pass, $name, $port);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed: " . $conn->connect_error
    ]));
}

?>