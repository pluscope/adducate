<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config.php");

$M_PASS = $_POST["M_PASS"];
$M_SN = $_SESSION["M_SN"];
$sql = "UPDATE M_MEMBER SET M_PASS = PASSWORD('$M_PASS')  WHERE M_SN = '$M_SN'";
$result = mysqli_query($conn, $sql);

?>
