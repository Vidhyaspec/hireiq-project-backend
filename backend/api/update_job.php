<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

include "../config/db.php";

// Accept both JSON payload and $_POST Form Data
$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'] ?? $_POST['id'] ?? null;
$title = $data['title'] ?? $_POST['title'] ?? null;
$description = $data['description'] ?? $_POST['description'] ?? null;
$skills = $data['skills'] ?? $_POST['skills'] ?? null;
$company = $data['company'] ?? $_POST['company'] ?? null;
$location = $data['location'] ?? $_POST['location'] ?? null;

if (!$id) {
    echo json_encode([
        "message" => "Invalid request. ID is required."
    ]);
    exit;
}

$sql = "
UPDATE jobs
SET
title='$title',
description='$description',
skills='$skills',
company='$company',
location='$location'
WHERE id='$id'
";

if ($conn->query($sql)) {
    echo json_encode([
        "message" => "Job Updated Successfully"
    ]);
} else {
    echo json_encode([
        "message" => "Update Failed"
    ]);
}
?>