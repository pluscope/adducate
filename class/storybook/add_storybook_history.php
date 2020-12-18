<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
function addHistory($storybook_id, $lesson_id, $conn, $isLogin, $userId){
    if($isLogin && $conn){
        $history_sql = "SELECT id FROM history WHERE user_id=%d and class_type_id=%d and contents_id=%d and lesson_id=%d";
        $history_sql = sprintf($history_sql, $userId, 2, $storybook_id, $lesson_id);
        $history_result = mysqli_query($conn, $history_sql);
        if($history_result->num_rows == 1){
            $history_insert_sql = "INSERT INTO history (user_id, class_type_id, contents_id, lesson_id) VALUES (%d, %d, %d, %d)";
            $history_insert_sql = sprintf($history_insert_sql, $userId, 2, $storybook_id, $lesson_id);
            mysqli_query($conn, $history_insert_sql);
        }
        return $history_sql;
    }
}
addHistory(intval($_POST["storybook_id"]), intval($_POST["lesson_id"]), $conn, $isLogin, $userId);
echo json_encode(array(1));
?>