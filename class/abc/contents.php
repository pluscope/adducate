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
<!--                        <a><span onclick="moveMp('a')">a</span></a>-->
<!---->
<!--                        <span onclick="moveMp('b')">b</span>-->
<!---->
<!--                        <span onclick="moveMp('c')">c</span>-->
<!---->
<!--                        <span onclick="moveMp('d')">d</span>-->
<!---->
<!--                        <span onclick="moveMp('e')">e</span>-->
<!---->
<!--                        <span onclick="moveMp('f')">f</span>-->
<!---->
<!--                        <span onclick="moveMp('g')">g</span>-->
<!---->
<!--                        <span onclick="moveMp('h')">h</span>-->
<!---->
<!--                        <span onclick="moveMp('i')">i</span>-->
<!---->
<!--                        <span onclick="moveMp('j')">j</span>-->
<!---->
<!--                        <span onclick="moveMp('k')">k</span>-->
<!---->
<!--                        <span onclick="moveMp('l')">l</span>-->
<!---->
<!--                        <span onclick="moveMp('m')">m</span>-->
<!---->
<!--                        <span onclick="moveMp('n')">n</span>-->
<!---->
<!--                        <span onclick="moveMp('o')">o</span>-->
<!---->
<!--                        <span onclick="moveMp('p')">p</span>-->
<!---->
<!--                        <span onclick="moveMp('q')">q</span>-->
<!---->
<!--                        <span onclick="moveMp('r')">r</span>-->
<!---->
<!--                        <span onclick="moveMp('s')">s</span>-->
<!---->
<!--                        <span onclick="moveMp('t')">t</span>-->
<!---->
<!--                        <span onclick="moveMp('u')">u</span>-->
<!---->
<!--                        <span onclick="moveMp('v')">v</span>-->
<!---->
<!--                        <span onclick="moveMp('w')">w</span>-->
<!---->
<!--                        <span onclick="moveMp('x')">x</span>-->
<!---->
<!--                        <span onclick="moveMp('y')">y</span>-->
<!---->
<!--                        <span onclick="moveMp('z')">z</span>-->
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

                        <video autoplay muted controls id="move_video">
                            <?php
                                $abc_motion = mysqli_fetch_array($abc_motions);
                                echo "<source type='video/mp4' id='movie_src' src='".$abc_motion["image"]."'></source>"
                            ?>
                        </video><div style="display: none;">Iteration: <span id="iteration"></span></div>
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
                    <div class="replay"><span class="textDefault whitetext bold">Replay</span></div>
                    <div class="sound"><span class="textDefault whitetext bold">Sound</span></div>
                    <div class="next"><span class="textDefault bold">Next</span></div>
                </div>
            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
