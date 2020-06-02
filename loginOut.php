<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_login_json.php");
$_SESSION = Array(); //OK

?>
<script>
	alert("Logout");
	location.href="/index.php";
</script>
