<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
if($_POST["uEmailChk"] == "on"){
    $sql = "INSERT INTO users (username, pw, first_name, last_name, is_privacy_check, sex, country_id, born_year, born_month) VALUES ('%s', '%s', '%s', '%s', %d, %d, %d, %d, %d)";
    $isPrivacyCheck = 0;
    if($_POST["priChk"] == "on")
        $isPrivacyCheck = 1;
    $pass = hash("sha256", "ajflwkejfo239!!@094#%nf".$_POST["userPass"]);
    $sql = sprintf($sql, $_POST['userNm'], $pass, $_POST["firstNm"], $_POST["lastNm"], $isPrivacyCheck, (int) $_POST["userSex"], (int) $_POST["uCountry"], (int) $_POST["uYear"], (int) $_POST["uMonth"]);
}else{
    $sql = "INSERT INTO users (username, pw, first_name, last_name, is_privacy_check, sex, country_id, born_year, born_month, email) VALUES ('%s', '%s', '%s', '%s', %d, %d, %d, %d, %d, '%s')";
    $isPrivacyCheck = 0;
    if($_POST["priChk"] == "on")
        $isPrivacyCheck = 1;
    $pass = hash("sha256", "ajflwkejfo239!!@094#%nf".$_POST["userPass"]);
    $sql = sprintf($sql, $_POST['userNm'], $pass, $_POST["firstNm"], $_POST["lastNm"], $isPrivacyCheck, (int) $_POST["userSex"], (int) $_POST["uCountry"], (int) $_POST["uYear"], (int) $_POST["uMonth"], $_POST["uEmail"]);
}
try {
    if($conn) {
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        echo("<script>location.href = '/welcome?userNm=".$_POST['userNm']."';</script>");
    }
    else {
        //@TODO Redirect to Error Page
        throw new Exception('Unable to connect');
    }
}
catch(Exception $e) {
    //@TODO Redirect to Error Page
    echo $e->getMessage();
}
?>