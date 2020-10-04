<?php
    include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
    include_once( $_SERVER["DOCUMENT_ROOT"]."/menu.php");
    $_SESSION["isLogin"] = True;
    $_SESSION["userNm"] = $_POST["userNm"];
    $_SESSION["userId"] = $_POST["userId"];
    echo "<script>location.href='/'</script>";
?>
