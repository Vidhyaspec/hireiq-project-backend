<?php

$isLocal = ($_SERVER['HTTP_HOST'] === 'localhost');

if ($isLocal) {
    // LOCALHOST
    $conn = new mysqli("localhost", "root", "", "hireiq");
} else {
    // LIVE SERVER (Render)
    $conn = new mysqli(
        "sql112.infinityfree.com",
        "if0_42125722",
        "VidhyaMahi",
        "if0_42125722_hireiq"
    );
}

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "DB connection failed"
    ]));
}

?>