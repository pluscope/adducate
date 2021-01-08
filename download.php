<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
if($conn) {
    $insert_sql = "INSERT INTO downloads (user_id) VALUES (%d)";
    $insert_sql = sprintf($insert_sql, intval($_POST["id"]));
    mysqli_query($conn, $insert_sql);
}
echo json_encode(array(1));

?>
