<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_json.php");

if ( mysqli_connect_errno() )

{
    echo "DB 연결에 실패했습니다 " . mysqli_connect_error();    
}


$sql = "INSERT INTO B_BOARD (";

$sqlBody ="";
$sqlValue ="";

$ii = 0;
foreach($_varArr as $x => $x_value) {
    $sqlBody .= $x;
    
    $sqlValue .= "'".$x_value."'";
    if($ii < count($_varArr)-1){
        $sqlBody .= ",";
        $sqlValue .= ",";
    }
    $ii++;
}

$sql .= $sqlBody.") ";
$sql .= "VALUES (".$sqlValue.")";

if(!mysqli_query($conn, $sql));
{
//    echo("쿼리오류 발생: " . mysqli_error($conn));    
}

echo $sql;
?>
