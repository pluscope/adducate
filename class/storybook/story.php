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
if($conn) {
    $lessons = mysqli_result_to_array(mysqli_query($conn, $lessons_sql));
    $total_lessons = count($lessons);
    $lesson = mysqli_result_to_array(mysqli_query($conn, $lesson_sql));
    $story = mysqli_result_to_array(mysqli_query($conn, $story_sql));
    $storybook = mysqli_fetch_array(mysqli_query($conn, $storybook_sql));
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
                        <div class="pointer"><span>Class</span><span> > Storybook</span><span> > <?php echo $storybook["title"] ?></span></div>

                        <div class="Lorem-text-overflow2">
                            <div class="push" id="alivePush">
                                <?php
                                    for($i=1; $i<=$total_lessons; ++$i){
                                        if($lesson_id == $lessons[$i-1]["id"]){
                                            echo "<span class='selected'>Lesson ".$i."</span>";
                                        }else{
                                            echo "<span>Lesson ".$i."</span>";
                                        }
                                    }

                                ?>
                            </div>
                            <hr>
                        </div>

                        <div id="story_title" class="title-div2 textDefault bold"><?php echo $lesson[0]["title"] ?></div>

                        <div class="storybox">
<!--                            @TODO 3 images-->
                            <?php
                                echo "<img id='story_img' class='image' src='".$story[0]["image"]."' />";
                            ?>
<!--                            <img id="story_img" class="image" src="/img/image.png" srcset="/img/image@2x.png 2x, /img/image@3x.png 3x" />-->
                            <div id="story_text" class="storywordbox textDefault">
                                <?php echo $story[0]["contents"] ?>
                            </div>

                            <img onClick="goLeftToClickStory()" class="bbtn_left_story" src="/img/scroll-btn(left).png" srcset="/img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x" />
                            <img onClick="goRightToClickStory()" class="bbtn_right_story" src="/img/scroll-btn(right).png" srcset="/img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x" />
                        </div>

                        <div class="greenarrows textDefault whitetext">
                            <div class="story">
                                <img class="arrow" src="/img/greenarrow_front.png" srcset="/img/greenarrow_front@2x.png 2x,
             ../img/greenarrow_front@3x.png 3x" />
                                <div class="arrowtext">story</div>
                            </div>

                            <div class="vocab" style="cursor: pointer;">
                                <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             ../img/grayarrow_middle@3x.png 3x" />
                                <div class="arrowtext" onclick="goUrl('page25.html')">Vocab</div>
                            </div>

                            <div class="vocabquiz" >
                                <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             ../img/grayarrow_middle@3x.png 3x" />
                                <div class="arrowtext">Vocab Quiz</div>
                            </div>

                            <div class="Sentence">
                                <img class="arrow" src="/img/grayarrow_last.png" srcset="/img/grayarrow_last@2x.png 2x,
             ../img/grayarrow_last@3x.png 3x" />
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
