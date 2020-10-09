<?php
    session_start();
    include_once($_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
    $userId = $_POST["userId"];
    $userPass = $_POST["userPass"];
    $hashedPass = hash("sha256", "ajflwkejfo239!!@094#%nf".$userPass);
    $sql = "SELECT * from users where username='%s' and pw='%s'";
    $sql = sprintf($sql, $userId, $hashedPass);
    if($conn) {
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if(mysqli_num_rows($result) == 0){
            echo("No information with this id and password.");
        }else if(mysqli_num_rows($result) == 1){
            $result = mysqli_fetch_array($result);
            $_SESSION["isLogin"] = True;
            $_SESSION["userNm"] = $result["username"];
            $_SESSION["userId"] = $result["id"];
            echo("y");
        }else{
            echo("There are more than one user with this id and password");
        }
    }
?>