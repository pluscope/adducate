<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$storybook_id = $_GET["storybook_id"];
$storybook_sql = "SELECT title FROM storybooks WHERE id=%d";
$storybook_sql = sprintf($storybook_sql, $storybook_id);
$first_story_sql = "SELECT a.id FROM storybook_lesson_stories a LEFT JOIN storybook_lessons b ON a.lesson_id = b.id LEFT JOIN storybooks c ON b.storybook_id = c.id WHERE c.id=%d ORDER BY a.id LIMIT 1";
$first_story_sql = sprintf($first_story_sql, $storybook_id);
$first_story_id = 0;
if($conn) {
    $storybook = mysqli_result_to_array(mysqli_query($conn, $storybook_sql))[0];
    if(mysqli_query($conn, $first_story_sql)->num_rows == 1){
        $first_story_id = mysqli_result_to_array(mysqli_query($conn, $first_story_sql))[0]["id"];
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

                    <div class="title-div2 textDefault bold">Please follow the guide</div>

                    <div class="alivebox">
                        <div class="alivewordbox textDefault">

                        </div>
                    </div>

                    <div class="greenarrows textDefault whitetext bold">
                        <div class="story" style="cursor: pointer" onclick="location.href='/class/alivebook/read/<?php echo $storybook_id."/".$first_story_id; ?>'">
                            <img class="arrow" src="/img/grayarrow_front.png" srcset="/img/grayarrow_front@2x.png 2x,
             /img/grayarrow_front@3x.png 3x" />
                            <div class="arrowtext">Read</div>
                        </div>

                        <div class="vocab" style="cursor: pointer" onclick="location.href='/class/alivebook/guide/<?php echo $storybook_id."/1"; ?>'">
                            <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x" />
                            <div class="arrowtext">Imagine & Draw</div>
                        </div>

                        <div class="vocabquiz">
                            <img class="arrow" src="/img/greenarrow_middle.png" srcset="/img/greenarrow_middle@2x.png 2x,
             /img/greenarrow_middle@3x.png 3x" />
                            <div class="arrowtext">Capture</div>
                        </div>

                        <div class="Sentence" style="cursor: pointer" onclick="location.href='/class/alivebook/play/<?php echo $storybook_id; ?>'">
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
