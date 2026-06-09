<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include "../config/db.php";

$sql = "
SELECT 
applications.id,
applications.job_id,
applications.user_id,
applications.resume,
applications.resume_skills,
applications.score,
UPPER(IFNULL(applications.status,'PENDING')) AS status,
jobs.title,
jobs.company,
users.name AS user_name
FROM applications
INNER JOIN jobs ON applications.job_id = jobs.id
INNER JOIN users ON applications.user_id = users.id
ORDER BY applications.id DESC
";

$result = $conn->query($sql);

if (!$result) {
  echo json_encode([
    "status" => "error",
    "message" => $conn->error
  ]);
  exit;
}

$applications = [];

while ($row = $result->fetch_assoc()) {
  $applications[] = $row;
}

echo json_encode($applications);

?>