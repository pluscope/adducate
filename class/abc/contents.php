<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$abc_id = $_GET["abc_id"];
$abc_contents_id = $_GET["abc_contents_id"];
$is_last_abc = 0;
$abc_contents_sql = "SELECT * FROM abc_contents where abc_id = ".$abc_id;
$abc_images_sql = "SELECT * FROM abc_images where abc_contents_id = ".$abc_contents_id;
$abc_motions_sql = "SELECT * FROM abc_motions where abc_contents_id = ".$abc_contents_id;
$abc_words_sql = "SELECT * FROM abc_words where abc_contents_id = ".$abc_contents_id;
$is_last_abc_sql = "SELECT id FROM abc_contents where id > ".$abc_contents_id." LIMIT 1";
if($conn) {
    $abc_contents = mysqli_query($conn, $abc_contents_sql);
    $abc_images = mysqli_query($conn, $abc_images_sql);
    $abc_motions = mysqli_query($conn, $abc_motions_sql);
    $abc_words = mysqli_query($conn, $abc_words_sql);
    $is_last_abc_result = mysqli_query($conn, $is_last_abc_sql);
    if($is_last_abc_result->num_rows == 0)
        $is_last_abc = 1;
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page22 html-->
<!--Show All ABC contents-->
<html>
<body>
<script>
    $(document).ready(function(){

    });

    function playAbcSound(){
        var iterations = 1;
        document.getElementById('iteration').innerText = iterations;
        document.getElementById('move_video').play();
        document.getElementById('abcAudio').play();
        document.getElementById('move_video').addEventListener('ended', function () {
            if(iterations < 3) {
                this.play();
                document.getElementById('abcAudio').play();
            }
            iterations ++;
            if(iterations == 4){
                playWordSound();
            }
        }, false);
    }
    function playWordSound(){
        document.getElementById('word1_sound').play();
        document.getElementById('word1_sound').addEventListener('ended', function () {
            document.getElementById('word1').style.display = 'none';
            document.getElementById('word2').style.display = 'block';
            document.getElementById('word2_sound').play();
            document.getElementById('word2_sound').addEventListener('ended', function () {
                document.getElementById('word2').style.display = 'none';
                document.getElementById('word3').style.display = 'block';
                document.getElementById('word3_sound').play();
                document.getElementById('word3_sound').addEventListener('ended', function () {
                    document.getElementById('word3').style.display = 'none';
                    document.getElementById('word1').style.display = 'block';
                }, false);
            }, false);
        }, false);
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
                    <div class="pointer"><span onclick="location.href='/class/'" class="hover-green" style="cursor: pointer;">Class</span><span> > ABC</span></div>
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
                            <audio id="abcAudio" preload="none" type="audio/mp4">
                                <source src="<?php echo $abc_motion["sound"]; ?>" type="audio/mp4">
                            </audio>
                        </div>
                        <div class="box">
                            <?php
                                $abc_words = mysqli_result_to_array($abc_words);
                                for($i=0; $i<count($abc_words); ++$i){
                                    echo "<img src='".$abc_words[$i]["image"]."' class='item' style='display:none;' id='word".($i+1)."'>";
                                    echo "<audio id='word".($i+1)."_sound' preload='none'>";
                                    echo "<source src = '".$abc_words[$i]["sound"]."'>";
                                    echo "</audio>";
                                }
                            ?>
                        </div>
                    </div>
<!--                    <div class="replay"><span class="textDefault whitetext bold" onclick="playAbcSound()" style="cursor: pointer;">Play</span></div>-->
                    <div class="sound"><span class="textDefault whitetext bold" onclick="playAbcSound()" style="cursor: pointer;">Play</span></div>
                    <?php
                        if($is_last_abc){
                            echo "<div class=\"next\"><span class=\"textDefault bold\" style=\"cursor: pointer\" onclick=\"location.href='/class/abc/'\">List</span></div>";
                        }
                        else{
                            $next_abc = mysqli_fetch_array($is_last_abc_result);
                            echo "<div class=\"next\"><span class=\"textDefault bold\" style=\"cursor: pointer\" onclick=\"location.href ='/class/abc/1/".$next_abc["id"]."'\">Next</span></div>";
                        }
                    ?>
                </div>
            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
