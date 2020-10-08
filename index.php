<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");

$isLogin =  isset($_SESSION["isLogin"])?$_SESSION["isLogin"]:"";
$userNm =  isset($_SESSION["userNm"])?$_SESSION["userNm"]:"";
?>

<title>Adducate Web App</title>
<link href="style.css" rel="stylesheet">
<script>
$(document).ready( function() {
    var isLogin = '<?= $isLogin ?>';
    var userNm = '<?= $userNm ?>';
	loginYn(isLogin, userNm);
});
</script>

</head>
<body>
<div id="temp1" style="display: none"> </div>
<div class="body">
  	
 	<div class="container" id="container-menu">
        <?php include($_SERVER["DOCUMENT_ROOT"]."/menu.php"); ?>
    </div>
    <div class="container" id="container-page">
        <div class="container-body-orange">
            <div class="mainLogo">
                <img
                        src="./img/logo_content.png"
                        srcset="./img/logo_content@2x.png 2x,./img/logo_content@3x.png 3x"/>
            </div>

            <div class="divBox1 textDefault">
                Adducate is designed to make learning more accessible and amusing for learners.
                From acquiring the sounds of each alphabet to understanding short stories, it stimulates children's' creativity. They will find learning fascinating and it will accelerate their growth.
                Adducate will empower the children without resources.
            </div>

            <div class="mainDownload"><span>Download</span></div>
        </div>
    </div>
  <!-- content end -->
  
</div>

</body>


</html>