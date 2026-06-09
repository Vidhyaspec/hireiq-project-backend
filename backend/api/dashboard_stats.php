<?php

header("Access-Control-Allow-Origin: *");

include "../config/db.php";

$jobs =
mysqli_num_rows(

    mysqli_query(
        $conn,
        "SELECT * FROM jobs"
    )

);

$applicants =
mysqli_num_rows(

    mysqli_query(
        $conn,
        "SELECT * FROM applications"
    )

);

$shortlisted =
mysqli_num_rows(

    mysqli_query(

        $conn,

        "SELECT * FROM applications
         WHERE status='Shortlisted'"

    )

);

$avgQuery =
mysqli_query(

    $conn,

    "SELECT AVG(score) as avg_score
     FROM applications"

);

$avgData =
mysqli_fetch_assoc($avgQuery);

$avgScore =
round($avgData['avg_score']);

echo json_encode([

    "jobs" => $jobs,

    "applicants" => $applicants,

    "shortlisted" => $shortlisted,

    "avgScore" => $avgScore

]);

?>
