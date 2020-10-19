<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$abc_id = $_GET["abc_id"];
$abc_contents_id = $_GET["abc_contents_id"];
$abc_contents_sql = "SELECT * FROM abc_contents where abc_id = ".$abc_id;
$abc_images_sql = "SELECT * FROM abc_images where abc_contents_id = ".$abc_contents_id;
$abc_motions_sql = "SELECT * FROM abc_motions where abc_contents_id = ".$abc_contents_id;
$abc_words_sql = "SELECT * FROM abc_words where abc_contents_id = ".$abc_contents_id;
if($conn) {
    $abc_contents = mysqli_query($conn, $abc_contents_sql);
    $abc_images = mysqli_query($conn, $abc_images_sql);
    $abc_motions = mysqli_query($conn, $abc_motions_sql);
    $abc_words = mysqli_query($conn, $abc_words_sql);
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page22 html-->
<!--Show All ABC contents-->
<html>
<body>
<script>
    window.onload = function() {

        var iterations = 1;
        document.getElementById('iteration').innerText = iterations;
        document.getElementById('move_video').addEventListener('ended', function () {
            if (iterations < 3) {
                this.currentTime = 0;
                this.play();
                iterations ++;
                document.getElementById('iteration').innerText = iterations;
            }
        }, false);
    };

    function playAbcSound(){
        var i;
        for(i=0; i<3; ++i){
            document.getElementById('move_video').play();
            document.getElementById('abcAudio').play();
        }
    }
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
                    <div class="pointer"><span>Class</span><span> > ABC</span></div>
                    <div class="abc_list">
                        <?php
                            foreach($abc_contents as $row){
                                echo "<a style='color: black; text-decoration: none;' href='/class/abc/".$abc_id."/".$row["id"]."'><span>".$row["description"]."</span></a>";
                            }
                        ?>
                      </div>
                    <div class="alphabet_box">
                        <div class="box">
                            <?php
                                $abc_image = mysqli_fetch_array($abc_images);
                                if($abc_image["image1"] && $abc_image["image2"])
                                    echo "<img src='".$abc_image["image1"]."' srcset='".$abc_image["image2"]." 2x, ".$abc_image["image3"]." 3x' class='item'>";
                                else
                                    echo "<img src='".$abc_image["image1"]."' class='item'>";
                            ?>
                        </div>
                        <div class="box">

                        <video muted id="move_video">
                            <?php
                                $abc_motion = mysqli_fetch_array($abc_motions);
                                echo "<source type='video/mp4' id='movie_src' src='".$abc_motion["image"]."' />"
                            ?>
                        </video><div style="display: none;">Iteration: <span id="iteration"></span></div>
                            <audio id="abcAudio" preload="none" src="<?php echo $abc_motion["sound"]; ?>" type="audio/mp4">
                                <source src="<?php echo $abc_motion["sound"]; ?>" type="audio/mp4">
                            </audio>
                        </div>
                        <div class="box">
                            <?php
                                $abc_word = mysqli_fetch_array($abc_words);
                                if($abc_word["image1"] && $abc_word["image2"])
                                    echo "<img src='".$abc_word["image1"]."' srcset='".$abc_word["image2"]." 2x, ".$abc_word["image3"]." 3x' class='item'>";
                                else
                                    echo "<img src='".$abc_word["image1"]."' class='item'>";
                            ?>
                        </div>
                    </div>
                    <div class="replay"><span class="textDefault whitetext bold" onclick="playAbcSound()" style="cursor: pointer;">Play</span></div>
<!--                    <div class="sound"><span class="textDefault whitetext bold">Sound</span></div>-->
                    <div class="next"><span class="textDefault bold">Next</span></div>
                </div>
            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
