<?php
    session_start();
    $location =  isset($_GET["location"])?$_GET["location"]:"";
    $isLogin =  isset($_SESSION["isLogin"])?$_SESSION["isLogin"]:"";
    $userNm =  isset($_SESSION["userNm"])?$_SESSION["userNm"]:"";
    $userId =  isset($_SESSION["userId"])?$_SESSION["userId"]:"";
?>
<html>
<title>Adducate</title>
<link href="/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
<head>
    <meta charset="utf-8"></meta>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> </meta>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="/js/jquery-1.11.3.min.js?v=System.currentTimeMillis()"></script>
    <script src="/js/common.js?v=System.currentTimeMillis()"></script>
    <link rel="icon" href="../img/favicon.ico"/>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/slick/slick.min.js"></script>
</head>
<script>
    $(document).ready( function() {
        var location = '<?= $location ?>';
        var isLogin = '<?= $isLogin ?>';
        var userNm = '<?= $userNm ?>';
        loginYn(isLogin, userNm);
    });
</script>
</html>