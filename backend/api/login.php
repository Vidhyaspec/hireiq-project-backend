<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit();
}

// FIX: correct DB include
include "../config/db.php";

// FIX: safe input handling
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    $data = $_POST;
}

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

// validation
if (!$email || !$password) {
    echo json_encode([
        "status" => "error",
        "message" => "No data received"
    ]);
    exit;
}

// FIX: check DB connection exists
if (!isset($conn)) {
    echo json_encode([
        "status" => "error",
        "message" => "DB not connected"
    ]);
    exit;
}

// query
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        echo json_encode([
            "status" => "success",
            "message" => "Login successful",
            "user" => $user
        ]);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => "Wrong password"
        ]);
    }

} else {

    echo json_encode([
        "status" => "error",
        "message" => "User not found"
    ]);
}

?>