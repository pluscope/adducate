<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_json.php");

$u_id = $_POST['u_id'];
$u_pass = $_POST['u_pass'];

$_SERVER_METHOD = $_SERVER['REQUEST_METHOD'];

if($_SERVER_METHOD == 'POST' && isset($u_id)){

$sql = "SELECT * FROM M_MEMBER WHERE M_ID = '".$u_id."' and M_PASS = password('".$u_pass."')";
$result = mysqli_query($conn, $sql);


$log_yn = 0;

    while($row = mysqli_fetch_array($result)) {
        $_SESSION['M_SN'] = $row['M_SN'];
        $_SESSION['M_ID'] = $row['M_ID'];
        $_SESSION['M_LEVEL'] = $row['M_LEVEL'];
        
        //관리자 로그인
        if( $row['M_LEVEL'] == 1 ){
            $log_yn = 1;
        }
        else {
      
            $log_yn = 2;
        }
    }

}
echo $log_yn;

?>
