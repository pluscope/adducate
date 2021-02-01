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
    if($isLogin){
        $history_sql = "SELECT id FROM history WHERE user_id=%d and class_type_id=%d and contents_id=%d";
        $history_sql = sprintf($history_sql, $userId, 3, $storybook_id);
        $history_result = mysqli_query($conn, $history_sql);
        if($history_result->num_rows == 0){
            $history_insert_sql = "INSERT INTO history (user_id, class_type_id, contents_id) VALUES (%d, %d, %d)";
            $history_insert_sql = sprintf($history_insert_sql, $userId, 3, $storybook_id);
            mysqli_query($conn, $history_insert_sql);
        }
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
    $(document).ready( function() {
        const colorThief = new ColorThief();
        const img = document.getElementById('story_img');
        var color = colorThief.getColor(img);
        var yiq = ((color[0]*299)+(color[1]*587)+(color[2]*114))/1000;
        var result = (yiq >= 128) ? 'black' : 'white';
        if(result=='black'){
            $(".storywordbox").children("span")[0].style.backgroundColor = 'white';
        }
        //console.log(window.getComputedStyle($(".storywordbox").children("span")[0]).backgroundColor);
    });
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
                            <span><?php echo $story["contents"] ?></span>
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

                    <div class="greenarrows textDefault whitetext bold">
                        <div class="story">
                            <img class="arrow" src="/img/greenarrow_front.png" srcset="/img/greenarrow_front@2x.png 2x,
             /img/greenarrow_front@3x.png 3x" />
                            <div class="arrowtext">Read</div>
                        </div>

                        <div class="vocab" style="cursor: pointer" onclick="location.href='/class/alivebook/guide/<?php echo $storybook_id."/1"; ?>'">
                            <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x" />
                            <div class="arrowtext">Draw</div>
                        </div>

                        <div class="vocabquiz"  style="cursor: pointer" onclick="location.href='/class/alivebook/capture/<?php echo $storybook_id."/1"; ?>'" >
                            <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x" />
                            <div class="arrowtext">Capture</div>
                        </div>

                        <div class="Sentence" style="cursor: pointer" onclick="location.href='/class/alivebook/play/<?php echo $storybook_id."/1"; ?>'" >
                            <img class="arrow_last" src="/img/grayarrow_last.png" srcset="/img/grayarrow_last@2x.png 2x,
             /img/grayarrow_last@3x.png 3x" />
                            <div class="arrowtext">Play</div>
                        </div>
                    </div>
                    <div class="next next3"><span class="textDefault bold" onclick="location.href='/class/alivebook'">Story List</span></div>
                </div>
            </div>
        </div>

    </div>
    <!-- content end-->
</div>
</div>

</body>


</html>
