<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$storybook_id = $_GET["storybook_id"];
$story_id = $_GET["story_id"];
$storybook_sql = "SELECT * FROM storybooks WHERE id=%d";
$storybook_sql = sprintf($storybook_sql, $storybook_id);
$story_sql = "SELECT * FROM storybook_lesson_stories WHERE id=%d";
$story_sql = sprintf($story_sql, $story_id);
$next_story_sql = "SELECT a.id FROM storybook_lesson_stories a LEFT JOIN storybook_lessons b ON a.lesson_id = b.id LEFT JOIN storybooks c ON b.storybook_id = c.id WHERE c.id=%d and a.id>%d ORDER BY a.id LIMIT 1";
$prev_story_sql = "SELECT a.id FROM storybook_lesson_stories a LEFT JOIN storybook_lessons b ON a.lesson_id = b.id LEFT JOIN storybooks c ON b.storybook_id = c.id WHERE c.id=%d and a.id<%d ORDER BY a.id DESC LIMIT 1";
$next_story_sql = sprintf($next_story_sql, $storybook_id, $story_id);
$prev_story_sql = sprintf($prev_story_sql, $storybook_id, $story_id);
$next_story_id = 0;
$prev_story_id = 0;
if($conn) {
    $storybook = mysqli_result_to_array(mysqli_query($conn, $storybook_sql))[0];
    $story = mysqli_result_to_array(mysqli_query($conn, $story_sql))[0];
    if(mysqli_query($conn, $next_story_sql)->num_rows == 1){
        $next_story_id = mysqli_result_to_array(mysqli_query($conn, $next_story_sql))[0]["id"];
    }
    if(mysqli_query($conn, $prev_story_sql)->num_rows == 1){
        $prev_story_id = mysqli_result_to_array(mysqli_query($conn, $prev_story_sql))[0]["id"];
    }
    //$story = mysqli_result_to_array($result);
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page38 html-->
<!--Show Alivebook Read Part-->
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
                    <div class="pointer"><span onclick="location.href='/class/'" class="hover-green" style="cursor: pointer;">Class</span><span> > </span><span onclick="location.href='/class/alivebook/'" class="hover-green" style="cursor: pointer;">Alivebook</span><span> > <?php echo $storybook["title"];?></span></div>

                    <div class="title-div2 textDefault bold">Read this story</div>

                    <div class="storybox">
                        <?php
                            echo "<img id='story_img' class='image' src='".$story["image"]."' />";
                        ?>
                        <!--                            <img id="story_img" class="image" src="/img/image.png" srcset="/img/image@2x.png 2x, /img/image@3x.png 3x" />-->
                        <div id="story_text" class="storywordbox textDefault">
                            <?php echo $story["contents"] ?>
                        </div>
                        <?php
                            if($prev_story_id != 0){
                                echo "<img style=\"cursor: pointer;\" onclick=\"location.href='/class/alivebook/read/".$storybook_id."/".$prev_story_id."'\" class=\"bbtn_left_story\" src=\"/img/scroll-btn(left).png\" srcset=\"/img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x\" />";
                            }
                            
                            if($next_story_id != 0){
                                echo "<img style=\"cursor: pointer;\" onclick=\"location.href='/class/alivebook/read/".$storybook_id."/".$next_story_id."'\" class=\"bbtn_right_story\" src=\"/img/scroll-btn(right).png\" srcset=\"/img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x\" />";
                            }else{
                                echo "<img style=\"cursor: pointer;\" onclick=\"location.href='/class/alivebook/guide/".$storybook_id."/1'\" class=\"bbtn_right_story\" src=\"/img/scroll-btn(right).png\" srcset=\"/img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x\" />";
                            }
                            ?>
                    </div>

                    <div class="greenarrows textDefault whitetext">
                        <div class="story">
                            <img class="arrow" src="/img/greenarrow_front.png" srcset="/img/greenarrow_front@2x.png 2x,
             /img/greenarrow_front@3x.png 3x" />
                            <div class="arrowtext">Read</div>
                        </div>

                        <div class="vocab" style="cursor: pointer" onclick="location.href='/class/alivebook/guide/<?php echo $storybook_id."/1"; ?>'">
                            <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x" />
                            <div class="arrowtext">Imagine & Draw</div>
                        </div>

                        <div class="vocabquiz">
                            <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x" />
                            <div class="arrowtext">Capture</div>
                        </div>

                        <div class="Sentence">
                            <img class="arrow" src="/img/grayarrow_last.png" srcset="/img/grayarrow_last@2x.png 2x,
             /img/grayarrow_last@3x.png 3x" />
                            <div class="arrowtext">Play</div>
                        </div>
                    </div>
                </div>
                <div class="next next3"><span class="textDefault bold" onclick="location.href='/class/alivebook'">Story List</span></div>
            </div>
        </div>

    </div>
    <!-- content end-->
</div>
</div>

</body>


</html>
