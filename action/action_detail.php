<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_json.php");
header("Content-Type:application/json");

// 1. 데이터베이스에서 데이터를 가져옴

$sql = "SELECT * FROM B_BOARD where B_SN='a1'";
$result = mysqli_query($conn,$sql);

    // 2. 데이터베이스로부터 반환된 데이터를
    // 객체 형태로 가공함
$list[] = array();
for( $i=0; $row=mysqli_fetch_array($result); $i++ ){
    $list[] = array( "B_SN"=> $row["B_SN"]);
}

echo json_encode($list);

?>