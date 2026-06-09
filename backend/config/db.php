<?php

// LOCALHOST
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {

    $conn = new mysqli("localhost", "root", "", "hireiq");

} else {

    // PRODUCTION (Render ENV VARIABLES)
    $conn = new mysqli(
        getenv("DB_HOST"),
        getenv("DB_USER"),
        getenv("DB_PASS"),
        getenv("DB_NAME")
    );
}

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed"
    ]));
}

?>