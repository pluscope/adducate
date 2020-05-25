<?php
session_start();
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/action/action_post.php");

if( !isset($_SESSION['M_SN']) ){
    ?>
    <script>
		alert("로그인 정보가 필요합니다.");
		location.href = "../login.php";
    </script>
    <?php
}

?>
