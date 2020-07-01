<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_login_json.php");
unset( $_SESSION['M_SN'] );
echo "<script>lcatio.href='../login.php'</script>";
?>
