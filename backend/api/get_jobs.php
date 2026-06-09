<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include "../config/db.php";

$sql = "SELECT * FROM jobs ORDER BY id DESC";

$result = $conn->query($sql);

if (!$result) {
  echo json_encode([
    "status" => "error",
    "message" => $conn->error
  ]);
  exit;
}

$jobs = [];

while ($row = $result->fetch_assoc()) {
  $jobs[] = $row;
}

echo json_encode($jobs);
?>