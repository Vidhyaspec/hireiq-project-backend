<?php

// Detect if running on localhost
$isLocal = (
    $_SERVER['HTTP_HOST'] === 'localhost' ||
    $_SERVER['HTTP_HOST'] === '127.0.0.1'
);

if ($isLocal) {
    // LOCAL XAMPP DATABASE
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "hireiq";
} else {
    // PRODUCTION (Render → InfinityFree DB)
    $host = "sql112.infinityfree.com";
    $user = "if0_42125722";
    $password = "VidhyaMahi";
    $database = "if0_42125722_hireiq";
}

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed"
    ]));
}

?>