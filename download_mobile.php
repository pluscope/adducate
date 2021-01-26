<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
if($conn) {
    $insert_sql = "INSERT INTO downloads (user_email, user_country) VALUES ('%s', %d)";
    $insert_sql = sprintf($insert_sql, $_POST["userEmail"], intval($_POST["userCountry"]));
    mysqli_query($conn, $insert_sql);
}
echo json_encode(array(1));
//echo json_encode($insert_sql);

?>
