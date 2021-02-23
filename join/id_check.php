<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$username = $_POST["username"];
$sql = "SELECT * from users where username='%s'";
$sql = sprintf($sql, $username);
if($conn) {
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if(mysqli_num_rows($result) == 0){
        echo 'ok';
    }else{
        echo "error";
    }
}
?>