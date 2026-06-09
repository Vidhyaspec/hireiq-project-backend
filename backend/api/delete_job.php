<?php

header("Access-Control-Allow-Origin: *");

include "../config/db.php";

$id = $_GET['id'];

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