<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * FROM classes";
if($conn) {
    $result = mysqli_query($conn, $sql);
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page2 html-->
<!--Show All classes-->
<html>
<body>
<script>

</script>
<div class="body">
    <div class="container" id="container-menu">
        <?php include($_SERVER["DOCUMENT_ROOT"]."/menu.php"); ?>
    </div>
    <div class="container" id="container-page">
        <!-- content start-->
        <div class="container">
            <div class="container-body container-expand">

                <div class="container-body-white">
                    <?php
                        foreach($result as $row){
                            echo "<a href='/class/".$row["url_name"]."'>";
                            echo "<img class='".$row["css_name"]."' src='".'..'.$row["image1"]."' srcset='".'..'.$row["image2"]." 2x,".'..'.$row["image3"]." 3x' />";
                            echo "</a>";
                            echo "<div class='divBox2 textDefault'>".$row["description"]." </div>";
                        }
                    ?>
<!--                    <img class="ABC" src="../img/abc.jpg" srcset="../img/abc@2x.jpg 2x,../img/abc@3x.jpg 3x" />-->
<!--                    <div class="divBox2 textDefault">-->
<!--                        Learn basic sounds of each alphabet and practice reading simple words.-->
<!--                    </div>-->
<!---->
<!--                    <img class="Storybook" src="../img/storybook.png" srcset="../img/storybook@2x.png 2x,../img/storybook@3x.png 3x" />-->
<!--                    <div class="divBox2 textDefault">-->
<!--                        Read short stories of objects in people’s daily lives and-->
<!--                        expand creativity through different aspects of learning.-->
<!--                    </div>-->
<!---->
<!--                    <img class="Alivebook" src="../img/alivebook.png" srcset="../img/alivebook@2x.png 2x,../img/alivebook@3x.png 3x" />-->
<!--                    <div class="divBox2 textDefault">-->
<!--                        Apply the knowledge and imagination-->
<!--                        into the process of creating a personal story book.-->
<!--                    </div>-->
<!---->
<!--                    <img class="Creation-Story" src="../img/creation-story.png" srcset="../img/creation-story@2x.png 2x,../img/creation-story@3x.png 3x" />-->
<!--                    <div class="divBox2 textDefault">-->
<!--                        Approach the origin of all the living creatures-->
<!--                        around the world through stories and features of the past-->
<!--                    </div>-->
                    <br>
                    <br>
                    <img class="bbtn" src="../img/scroll-btn.png" srcset="../img/scroll-btn@2x.png 2x,../img/scroll-btn@3x.png 3x" />
                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
