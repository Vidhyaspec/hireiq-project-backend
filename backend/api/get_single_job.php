<?php

header("Access-Control-Allow-Origin: *");

include("../config/db.php");

$id = $_GET['id'];

$sql = "SELECT * FROM jobs WHERE id='$id'";

$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);

echo json_encode($row);

?>

