<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

include "../config/db.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode([
        "message" => "ID is required"
    ]);
    exit;
}

$sql = "DELETE FROM jobs WHERE id='$id'";

if ($conn->query($sql)) {

    echo json_encode([
        "message" => "Job Deleted Successfully"
    ]);

} else {

    echo json_encode([
        "message" => "Delete Failed"
    ]);
}
?>