<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
function addCreationStoriesHistory($id, $category, $conn, $isLogin, $userId){
    if($conn) {
        if ($isLogin) {
            $history_sql = "SELECT id FROM history WHERE user_id=%d and class_type_id=%d and contents_id=%d";
            $history_sql = sprintf($history_sql, $userId, 4, $id);
            $history_result = mysqli_query($GLOBALS['conn'], $history_sql);
            if ($history_result->num_rows == 1) {
                $history_insert_sql = "INSERT INTO history (user_id, class_type_id, contents_id, lesson_id) VALUES (%d, %d, %d, %d)";
                $history_insert_sql = sprintf($history_insert_sql, $userId, 4, $id, $category);
                mysqli_query($GLOBALS['conn'], $history_insert_sql);
            }
        }
    }
}
addCreationStoriesHistory(intval($_POST["id"]), intval($_POST["category"]), $conn, $isLogin, $userId);
echo json_encode(array(1));

?>
