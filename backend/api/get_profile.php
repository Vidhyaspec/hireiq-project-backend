<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

include "../config/db.php";

$user_id = $_GET['user_id'];

$sql = "SELECT
name,
email,
bio,
skills,
education,
experience,
github,
linkedin,
profile_pic
FROM users
WHERE id='$user_id'";

$result = $conn->query($sql);

if($result->num_rows > 0){

  echo json_encode(
    $result->fetch_assoc()
  );

}else{

  echo json_encode([
    "message" => "User not found"
  ]);

}

?>