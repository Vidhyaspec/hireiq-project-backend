<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "hireiq";

if (getenv("ENV") === "production") {
    $host = "YOUR_RENDER_DB_HOST";
    $user = "YOUR_RENDER_DB_USER";
    $password = "YOUR_RENDER_DB_PASSWORD";
    $database = "YOUR_RENDER_DB_NAME";
}

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed: " . $conn->connect_error
    ]));
}

?>