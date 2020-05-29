<?php

// get일 경우 사용 iconv('euc-kr', 'utf-8',$_GET["B_ADDRES"])
$_varArr = Array(
    "B_ID"            => isset($_POST["B_ID"])           ? $_POST["B_ID"] : "" ,
    "B_TITLE"         => isset($_POST["B_TITLE"])        ? $_POST["B_TITLE"] : "" ,
    "B_ADDRES"        => isset($_POST["B_ADDRES"])       ? $_POST["B_ADDRES"] : "" ,
    "B_LAT"           => isset($_POST["B_LAT"])          ? $_POST["B_LAT"] : "",
    "B_LNG"           => isset($_POST["B_LNG"])          ? $_POST["B_LNG"] : "",
    "B_MUL_IMAGE"     => isset($_POST["B_MUL_IMAGE"])    ? $_POST["B_MUL_IMAGE"] : "",
    "B_HOME"          => isset($_POST["B_HOME"])         ? $_POST["B_HOME"] : "",
    "B_TEL"           => isset($_POST["B_TEL"])          ? $_POST["B_TEL"] : ""
);


?>