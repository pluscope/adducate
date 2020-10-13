<?php
    include_once($_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
    $username = $_POST["username"];
    $email = $_POST["email"];
    $sql = "SELECT pw from users where username='%s' or email='%s'";
    $sql = sprintf($sql, $username, $email);
    if($conn) {
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if(mysqli_num_rows($result) == 0){
            echo 'No User';
        }else if(mysqli_num_rows($result) == 1){
            $result = mysqli_fetch_array($result);
            echo $result["pw"];
        }else{
            echo "Error";
        }
    }
?>