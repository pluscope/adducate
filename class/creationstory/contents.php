<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$id = $_GET["id"];
$sql = "SELECT * FROM creationstories WHERE id=%d";
$sql = sprintf($sql, $id);
if($conn) {
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($result);
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page41 html-->
<!--Show CreationStory Contents-->
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
                <div class="container-body-white-center">
                    <div class="pointer"><span>Class</span><span> > Creation Story</span><span> >
                            <?php
                                if($result["category"]==0)
                                    echo "Old";
                                else if($result["category"]==1)
                                    echo "New";
                            ?></span></div>
                    <div class="creationbox">
                        <div class="first">
                            <video autoplay muted controls style="width: 100%; height: 100%;">
                                <?php
                                    echo "<source type='video/mp4' src='".$result["video_link"]."'></source>";
                                ?>
                            </video>
                        </div>

                        <div class="storywordbox textDefault">
                            <div class="sentence-div textDefault bold">Today's sentence</div>
                            <?php
                                echo $result["key_sentence"];
                            ?>
                        </div>
                    </div>
                </div>
                <div class="next next4"><span class="textDefault bold" onclick="location.href='/class/creationstory'">Story List</span></div>
            </div>
        </div>

    </div>
    <!-- content end-->
</div>
</div>

</body>


</html>
