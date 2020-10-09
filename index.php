<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");

$isLogin =  isset($_SESSION["isLogin"])?$_SESSION["isLogin"]:"";
$userNm =  isset($_SESSION["userNm"])?$_SESSION["userNm"]:"";
$sql = "SELECT * FROM classes";
if($conn) {
    $result = mysqli_query($conn, $sql);
}else{
    //@TODO alert message when the connection is not connected
}
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
<div class="body" id="mainBody">
  	
 	<div class="container" id="container-menu">
        <?php include($_SERVER["DOCUMENT_ROOT"]."/menu.php"); ?>
    </div>
    <div class="container" id="container-page">
        <div class="container-body-orange" id="mainContainer">
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
        <br />
        <div class="container-body-white" id = "classContainer">
            <?php
            foreach($result as $row){
                echo "<a href='/class/".$row["url_name"]."'>";
                echo "<img class='".$row["css_name"]."' src='".'..'.$row["image1"]."' srcset='".'..'.$row["image2"]." 2x,".'..'.$row["image3"]." 3x' />";
                echo "</a>";
                echo "<div class='divBox2 textDefault'>".$row["description"]."</div>";
            }
            ?>
            <br />
            <img class="bbtn" style="cursor: pointer;" onclick="doScrolling('#teamContainer', 1000)" src="../img/scroll-btn.png" srcset="../img/scroll-btn@2x.png 2x,../img/scroll-btn@3x.png 3x" />
        </div>
        <br />
        <div class="container-body-blue" id="teamContainer">

            <div class="leftPath5" style="background-image:url('/img/leftPath5.png') ">

            </div>

            <div class="leftPath4" style="background-image:url('/img/leftPath4.png') ">

            </div>

            <div class="mainPath" style="background-image:url('/img/path.png');width:500px;height:320px;">

            </div>


            <div class="rightPath3" style="background-image:url('/img/rightPath1.png')">

            </div>

            <div class="rightPath2" style="background-image:url('/img/rightPath2.png')">

            </div>

            <img onclick="doScrolling('#aboutContainer', 1000)" style="cursor: pointer;"
                 class="bbtn_bottom"
                    src="/img/scroll-btn.png"
                    srcset="/img/scroll-btn@2x.png 2x,/img/scroll-btn@3x.png 3x"/>
        </div>
        <br />
        <div class="Background_white" id="aboutContainer">

            <div class="divBox4">
                <div class="orangeBox textDefault f36 bold">
                    Class Manual
                </div>
                <div class="blueBox textDefault f36 bold">
                    FAQ
                </div>
                <div class="greenBox textDefault f36 bold">
                    Blog
                </div>
            </div>

            <div class="email textDefault bluetext">
                contact@adducate.net
            </div>
            <br />
            <div class="scroll-top">
                <img onclick="doScrolling('#mainBody', 2000)" style="cursor: pointer;" src="/img/scroll-top.png" srcset="/img/scroll-top@2x.png 2x,/img/scroll-top@3x.png 3x">
            </div>
            <br />
            <br />
        </div>
    </div>
  <!-- content end -->
  
</div>

</body>


</html>