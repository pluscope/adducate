<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config.php");

$b_id = $_POST["B_ID"];
$b_title = $_POST["B_TITLE"];

$sql = "INSERT INTO B_BOARD (B_ID,B_TITLE) VALUES ('$b_id','$b_title')";
$result = mysqli_query($conn, $sql);

?>
