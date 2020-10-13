<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$storybook_id = $_GET["storybook_id"];
$lesson_id = $_GET["lesson_id"];
$storybook_sql = "SELECT title from storybooks where id=%d";
$storybook_sql = sprintf($storybook_sql, $storybook_id);
$lessons_sql = "SELECT * from storybook_lessons where storybook_id=%d ORDER BY id";
$lessons_sql = sprintf($lessons_sql, $storybook_id);
$lesson_sql = "SELECT * from storybook_lessons where id=%d";
$lesson_sql = sprintf($lesson_sql, $lesson_id);
$page_id = $_GET["page_id"];
$vocab_sql = "SELECT * from storybook_lesson_vocabs WHERE lesson_id=%d ORDER BY id  LIMIT %d, 3";
$vocab_sql = sprintf($vocab_sql, $lesson_id, ($page_id-1)*3);
$sql = "SELECT count(id) as cnt from storybook_lesson_vocabs WHERE lesson_id=".$lesson_id;
$first_story_sql = "SELECT id from storybook_lesson_stories where lesson_id=%d ORDER BY id LIMIT 1";
$first_story_sql = sprintf($first_story_sql, $lesson_id);
$is_last_page = 0;
if($conn) {
    $total_vocabs = mysqli_result_to_array(mysqli_query($conn, $sql))[0]["cnt"];
    $first_story_id = mysqli_result_to_array(mysqli_query($conn, $first_story_sql))[0]["id"];
    if($total_vocabs - ($page_id-1)*3 <= 3)
        $is_last_page = 1;
    $vocabs = mysqli_result_to_array(mysqli_query($conn, $vocab_sql));
    $lessons = mysqli_result_to_array(mysqli_query($conn, $lessons_sql));
    $total_lessons = count($lessons);
    $lesson = mysqli_result_to_array(mysqli_query($conn, $lesson_sql));
    $storybook = mysqli_fetch_array(mysqli_query($conn, $storybook_sql));
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
                        <div class="pointer"><span>Class</span><span> > Storybook</span><span> > <?php echo $storybook["title"] ?></span></div>

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

                        <div id="story_title" class="title-div2 textDefault bold"><?php echo $lesson[0]["title"] ?></div>

                        <div class="storybox">
                            <div id="vocList" class="divBox25 textDefault">
                                <?php
                                    foreach ($vocabs as $vocab){
                                        echo "<div class='word'>".$vocab["vocab"]."</div>";
                                        echo "<div class='wordmeaning'>".$vocab["meaning"]."</div>";
                                        echo "<br />";
                                    }
                                ?>
                            </div>
                            <?php
                                if($page_id>1){
                                    echo "<img onclick=\"location.href='/class/storybook/vocab/".$storybook_id."/".$lesson_id."/".($page_id-1)."'\"
                                 class=\"bbtn_left_story\" style=\"cursor: pointer;\"
                                 src=\"/img/scroll-btn(left).png\"
                                 srcset=\"/img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x\"/>";
                                }
                                if($is_last_page!=1){
                                    echo "<img onclick=\"location.href='/class/storybook/vocab/".$storybook_id."/".$lesson_id."/".($page_id+1)."'\"
                                 class=\"bbtn_right_story\" style=\"cursor: pointer;\"
                                 src=\"/img/scroll-btn(right).png\" 
                                 srcset=\"/img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x\"/>";
                                }
                            ?>
                        </div>

                        <div class="greenarrows textDefault whitetext">
                            <div class="story" style="cursor: pointer;" onclick="location.href='/class/storybook/story/<?php echo $storybook_id."/".$lesson_id."/".$first_story_id; ?>'">
                                <img
                                        class="arrow"
                                        src="/img/grayarrow_front.png"
                                        srcset="/img/grayarrow_front@2x.png 2x,
             /img/grayarrow_front@3x.png 3x"/>
                                <div class="arrowtext">Story</div>
                            </div>

                            <div class="vocab" >
                                <img
                                        class="arrow"
                                        src="/img/greenarrow_middle.png"
                                        srcset="/img/greenarrow_middle@2x.png 2x,
             /img/greenarrow_middle@3x.png 3x"/>
                                <div class="arrowtext">Vocab</div>
                            </div>

                            <div class="vocabquiz" style="cursor: pointer;" onclick="location.href='/class/storybook/vocabquiz/<?php echo $storybook_id."/".$lesson_id."/1"; ?>'">
                                <img
                                        class="arrow"
                                        src="/img/grayarrow_middle.png"
                                        srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x"/>
                                <div class="arrowtext">Vocab Quiz</div>
                            </div>

                            <div class="Sentence">
                                <img
                                        class="arrow"
                                        src="/img/grayarrow_last.png"
                                        srcset="/img/grayarrow_last@2x.png 2x,
             /img/grayarrow_last@3x.png 3x"/>
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
