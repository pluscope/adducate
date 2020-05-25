<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_json.php");
header("Content-Type:application/json");

$search = $_POST["searchYmd"];
$searchY = $_POST["searchY"];
$searchM = $_POST["searchM"];

$sql = "SELECT DAY ,COUNT(*) CNT FROM LOG WHERE YEAR = '$searchY' AND CAST(MONTH AS UNSIGNED) = '$searchM' GROUP BY DAY";
if( $search == "2" ){
    $sql = "SELECT CAST(MONTH AS UNSIGNED) as DAY,COUNT(*) CNT FROM LOG WHERE YEAR = '2020'  GROUP BY MONTH";
}else if( $search == "3" ){
    $sql = "SELECT YEAR AS DAY ,COUNT(*) CNT FROM LOG GROUP BY YEAR LIMIT 0,5 ";
}

$result = mysqli_query($conn,$sql);

    // 2. 데이터베이스로부터 반환된 데이터를
    // 객체 형태로 가공함
$list = [];
for( $i=0; $row=mysqli_fetch_array($result); $i++ ){
    $list[] = array( "DAY"=> $row["DAY"],"CNT"=>$row["CNT"]);
}

$result = array("result" => $list);
echo json_encode($result);

?>