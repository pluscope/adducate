<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * FROM history WHERE user_id = ".$userId;
if($conn) {
    $result = mysqli_result_to_array(mysqli_query($conn, $sql));
    //print_r($result);
}else{
    //@TODO alert message when the connection is not connected
}
?>

<title>Adducate</title>
<link href="style.css" rel="stylesheet">
</head>
<body>
<div id="temp1" style="display: none"> </div>
<div class="body" id="mainBody">
    <div class="container" id="container-menu">
        <?php include($_SERVER["DOCUMENT_ROOT"]."/menu.php"); ?>
    </div>
    <div class="container" id="container-page">
        <!-- content start-->
        <div class="container">
            <div class="container-body container-expand">

                <div class="container-body-white-left">
                    <img onclick="goUrl('page21.html')" class="ABC" src="/img/abc.jpg" srcset="/img/abc@2x.jpg 2x,/img/abc@3x.jpg 3x" />
                    <div class="Lorem-text-overflow">
                        <div class="push" id="abcPush">
                            <span class="selected">Alphabet</span>
                            <span>Short Vowels</span>
                        </div>
                    </div>
                    <hr>

                    <img onclick="goUrl('page23.html')" class="Storybook" src="/img/storybook.png" srcset="/img/storybook@2x.png 2x,/img/storybook@3x.png 3x" />
                    <div class="Lorem-text-overflow">
                        <div class="push" id="storyPush">
                            <span>Story 1</span>
                            <span>Story 2</span>
                            <span class="selected">Story 3</span>
                        </div>
                    </div>
                    <hr>

                    <img class="Alivebook" src="/img/alivebook.png" srcset="/img/alivebook@2x.png 2x,/img/alivebook@3x.png 3x" />
                    <div class="Lorem-text-overflow">
                        <div class="push" id="alivePush">
                            <span>Story 1</span>
                            <span>Story 2</span>
                            <span class="selected">Story 3</span>
                        </div>
                    </div>
                    <hr>

                    <img class="Creation-Story" src="/img/creation-story.png" srcset="/img/creation-story@2x.png 2x,/img/creation-story@3x.png 3x" />
                    <div class="Lorem-text-overflow">
                        <div class="push" id="createPush">
                            <span>Story 1</span>
                            <span>Story 2</span>
                            <span class="selected">Story 3</span>
                            <span>Story 4</span>
                            <span>Story 5</span>
                            <span>Story 6</span>
                            <span>Story 7</span>
                            <span>Story 8</span>
                            <span>Story 9</span>
                            <span>Story 10</span>
                            <span>Story 11</span>
                            <span>Story 12</span>
                            <span>Story 13</span>
                        </div>
                    </div>
                    <hr>
<!--                    <div class="bbtn_move">-->
<!---->
<!--                        <img class="bbtn_left_move" onclick="moveleft()" src="../img/scroll-btn(left).png" srcset="../img/scroll-btn(left)@2x.png 2x,../img/scroll-btn(left)@3x.png 3x" />-->
<!--                        <img class="bbtn_right_move" onclick="moveright()" src="../img/scroll-btn(right).png" srcset="../img/scroll-btn(right)@2x.png 2x,../img/scroll-btn(right)@3x.png 3x" />-->
<!---->
<!--                    </div>-->
                </div>

            </div>
        </div>
        <!-- content end-->
    </div>
  <!-- content end -->
  
</div>

</body>


</html>