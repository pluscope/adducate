<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_json.php");
header("Content-Type:application/json");

// 1. 데이터베이스에서 데이터를 가져옴
$B_SN = $_POST["B_SN"];
$sql = "DELETE FROM B_BOARD where B_SN='$B_SN'";
mysqli_query($conn,$sql);

$result = array("result" => "Y");
echo json_encode($result);

?>