<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_json.php");
$_SERVER_METHOD = $_SERVER['REQUEST_METHOD'];

if($_SERVER_METHOD == 'POST'){
    
    
$_type =  isset($_POST["s_type"]) ? $_POST["s_type"]:"";
    
$_userNm =  isset($_POST["s_userNm"]) ? $_POST["s_userNm"]:"";
$_userPass =  isset($_POST["s_userPass"]) ? $_POST["s_userPass"]:"";
$_userSex =  isset($_POST["s_userSexs"]) ? $_POST["s_userSexs"]:"";
$_userContry =  isset($_POST["s_userContry"]) ? $_POST["s_userContry"]:"";

$_userMonth =  isset($_POST["s_userMonth"]) ? $_POST["s_userMonth"]:"";
$_userYear =  isset($_POST["s_userYear"]) ? $_POST["s_userYear"]:"";

$_userEmail =  isset($_POST["s_userEmail"]) ? $_POST["s_userEmail"]:"";
$_userEmailChk =  isset($_POST["s_userEmailChk"]) ? $_POST["s_userEmailChk"]:"";
$_message = "";
$sql = $_type;
    if( $_type == "select" ){
        $sql = "SELECT * FROM M_MEMBER WHERE M_ID = '".$u_id."' and M_PASS = password('".$u_pass."')";
        $result = mysqli_query($conn, $sql);
        
        $log_yn = 0;
        
            while($row = mysqli_fetch_array($result)) {
                $_SESSION['M_SN'] = $row['M_SN'];
                $_SESSION['M_ID'] = $row['M_ID'];
                $_SESSION['M_LEVEL'] = $row['M_LEVEL'];
                
                if( $row['M_LEVEL'] == 1 ){
                    $log_yn = 1;
                }
                else {
              
                    $log_yn = 2;
                }
            }
        
        }
    if( $_type == "insert" ){
        
        $sql = "SELECT * FROM M_MEMBER WHERE M_ID = '".$_userNm."'";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) == 0){
            $sql = "INSERT M_MEMBER (	M_ID,M_NAME,M_PASS,M_SEX,M_CONTRY,M_YEAR,M_MONTH,M_EMAIL,M_EMAIL_CHK) VALUES ('$_userNm','$_userNm','$_userPass','$_userSex','$_userContry','$_userYear','$_userMonth','$_userEmail','$_userEmailChk' )";
                $result = mysqli_query($conn, $sql);
                $_message = "가입 완료";
        }else{
            $_message = "중복 ID error";
        }
    }
}
echo $_message;
?>
