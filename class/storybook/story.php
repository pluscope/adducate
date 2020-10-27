<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$storybook_id = $_GET["storybook_id"];
$lesson_id = $_GET["lesson_id"];
$story_id = $_GET["story_id"];
$storybook_sql = "SELECT title from storybooks where id=%d";
$storybook_sql = sprintf($storybook_sql, $storybook_id);
$lessons_sql = "SELECT * from storybook_lessons where storybook_id=%d ORDER BY id";
$lessons_sql = sprintf($lessons_sql, $storybook_id);
$lesson_sql = "SELECT * from storybook_lessons where id=%d";
$lesson_sql = sprintf($lesson_sql, $lesson_id);
$story_sql = "SELECT * from storybook_lesson_stories where id=%d";
$story_sql = sprintf($story_sql, $story_id);
$next_story_id = 0;
$prev_story_id = 0;
$next_story_sql = "SELECT id from storybook_lesson_stories where id>%d and lesson_id=%d ORDER BY id LIMIT 1";
$next_story_sql = sprintf($next_story_sql, $story_id, $lesson_id);
$prev_story_sql = "SELECT id from storybook_lesson_stories where id<%d and lesson_id=%d ORDER BY id DESC LIMIT 1";
$prev_story_sql = sprintf($prev_story_sql, $story_id, $lesson_id);
if($conn) {
    $lessons = mysqli_result_to_array(mysqli_query($conn, $lessons_sql));
    $total_lessons = count($lessons);
    $lesson = mysqli_result_to_array(mysqli_query($conn, $lesson_sql));
    $story = mysqli_result_to_array(mysqli_query($conn, $story_sql));
    $storybook = mysqli_fetch_array(mysqli_query($conn, $storybook_sql));
    if(mysqli_query($conn, $next_story_sql)->num_rows == 1){
        $next_story_id = mysqli_result_to_array(mysqli_query($conn, $next_story_sql))[0]["id"];
    }
    if(mysqli_query($conn, $prev_story_sql)->num_rows == 1){
        $prev_story_id = mysqli_result_to_array(mysqli_query($conn, $prev_story_sql))[0]["id"];
    }
    for($i=0; $i<$total_lessons; ++$i){
        $sql = "SELECT id from storybook_lesson_stories WHERE lesson_id=%d ORDER BY id LIMIT 1";
        $sql = sprintf($sql, $lessons[$i]["id"]);
        $lessons[$i]["first_story_id"] = mysqli_result_to_array(mysqli_query($conn, $sql))[0]["id"];
    }
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page24 html-->
<!--Show Storiess-->
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
                        <div class="pointer"><span onclick="location.href='/class/'" class="hover-green" style="cursor: pointer;">Class</span><span> > </span><span class="hover-green" onclick="location.href='/class/storybook/'" style="cursor: pointer;">Storybook</span><span> > <?php echo $storybook["title"] ?></span></div>

                        <div class="Lorem-text-overflow2">
                            <div class="push" id="alivePush">
                                <?php
                                    for($i=1; $i<=$total_lessons; ++$i){
                                        if($lesson_id == $lessons[$i-1]["id"]){
                                            echo "<span style=\"cursor: pointer;\" onclick=\"location.href='/class/storybook/story/".$storybook_id."/".$lessons[$i-1]["id"]."/".$lessons[$i-1]["first_story_id"]."'\" class=\"selected\">Lesson ".$i."</span>";
                                        }else{
                                            echo "<span style=\"cursor: pointer;\" onclick=\"location.href='/class/storybook/story/".$storybook_id."/".$lessons[$i-1]["id"]."/".$lessons[$i-1]["first_story_id"]."'\">Lesson ".$i."</span>";
                                        }
                                    }

                                ?>
                            </div>
                            <hr>
                        </div>

                        <div id="story_title" class="title-div2 textDefault bold">Title - <?php echo $lesson[0]["title"] ?></div>

                        <div class="storybox">
<!--                            @TODO 3 images-->
                            <?php
                                echo "<img id='story_img' class='image' src='".$story[0]["image"]."' />";
                            ?>
<!--                            <img id="story_img" class="image" src="/img/image.png" srcset="/img/image@2x.png 2x, /img/image@3x.png 3x" />-->
                            <div id="story_text" class="storywordbox textDefault">
                                <?php echo $story[0]["contents"] ?>
                            </div>
                            <?php
                                if($prev_story_id != 0){
                                    echo "<img onClick=\"location.href='/class/storybook/story/".$storybook_id."/".$lesson_id."/".$prev_story_id."'\" style=\"cursor: pointer;\" class=\"bbtn_left_story\" src=\"/img/scroll-btn(left).png\" srcset=\"/img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x\" />";
                                }
                                if($next_story_id != 0){
                                echo "<img onClick=\"location.href='/class/storybook/story/".$storybook_id."/".$lesson_id."/".$next_story_id."'\" style=\"cursor: pointer;\" class=\"bbtn_right_story\" src=\"/img/scroll-btn(right).png\" srcset=\"/img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x\" />";
                                }
                                if($next_story_id == 0){
                                    echo "<img onClick=\"location.href='/class/storybook/vocab/".$storybook_id."/".$lesson_id."/1'\" style=\"cursor: pointer;\" class=\"bbtn_right_story\" src=\"/img/scroll-btn(right).png\" srcset=\"/img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x\" />";
                                }
                            ?>
                        </div>

                        <div class="greenarrows textDefault whitetext">
                            <div class="story">
                                <img class="arrow" src="/img/greenarrow_front.png" srcset="/img/greenarrow_front@2x.png 2x,
             /img/greenarrow_front@3x.png 3x" />
                                <div class="arrowtext">Story</div>
                            </div>

                            <div class="vocab" style="cursor: pointer;" onclick="location.href='/class/storybook/vocab/<?php echo $storybook_id."/".$lesson_id."/1"; ?>'">
                                <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x" />
                                <div class="arrowtext" >Vocab</div>
                            </div>

                            <div class="vocabquiz" style="cursor: pointer;" onclick="location.href='/class/storybook/vocabquiz/<?php echo $storybook_id."/".$lesson_id."/1"; ?>'">
                                <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x" />
                                <div class="arrowtext">Vocab Quiz</div>
                            </div>

                            <div class="Sentence" style="cursor: pointer;" onclick="location.href='/class/storybook/sentence/<?php echo $storybook_id."/".$lesson_id."/1"; ?>'">
                                <img class="arrow" src="/img/grayarrow_last.png" srcset="/img/grayarrow_last@2x.png 2x,
             /img/grayarrow_last@3x.png 3x" />
                                <div class="arrowtext">Sentence</div>
                            </div>
                        </div>
                    </div>
                    <div class="next next2"><span class="textDefault bold" onclick="location.href='/class/storybook'">Story List</span></div>
            </div>
        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
