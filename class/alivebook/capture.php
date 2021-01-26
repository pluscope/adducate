<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$storybook_id = $_GET["storybook_id"];
$page_id = $_GET["page_id"];
$storybook_sql = "SELECT title FROM storybooks WHERE id=%d";
$storybook_sql = sprintf($storybook_sql, $storybook_id);
$first_story_sql = "SELECT a.id FROM storybook_lesson_stories a LEFT JOIN storybook_lessons b ON a.lesson_id = b.id LEFT JOIN storybooks c ON b.storybook_id = c.id WHERE c.id=%d ORDER BY a.id LIMIT 1";
$first_story_sql = sprintf($first_story_sql, $storybook_id);
$first_story_id = 0;
$guide_sql = "SELECT ag.id, ag.image, ag.contents FROM alivebook_guides ag LEFT JOIN alivebook_guide_mapping agm ON ag.id = agm.guide_id LEFT JOIN alivebooks a ON agm.alivebook_id=a.id WHERE a.id = %d and ag.category='capture' LIMIT %d, 1";
$guide_sql = sprintf($guide_sql, $storybook_id, ($page_id-1));
$is_last_page = 0;
$total_page_sql = "SELECT count(ag.id) as cnt FROM alivebook_guides ag LEFT JOIN alivebook_guide_mapping agm ON ag.id = agm.guide_id LEFT JOIN alivebooks a ON agm.alivebook_id=a.id WHERE a.id = %d and ag.category='capture'";
$total_page_sql = sprintf($total_page_sql, $storybook_id);
$total_guide_sql = "SELECT count(ag.id) as cnt FROM alivebook_guides ag LEFT JOIN alivebook_guide_mapping agm ON ag.id = agm.guide_id LEFT JOIN alivebooks a ON agm.alivebook_id=a.id WHERE a.id = %d and ag.category='guide'";
$total_guide_sql = sprintf($total_guide_sql, $storybook_id);
if($conn) {
    $storybook = mysqli_result_to_array(mysqli_query($conn, $storybook_sql))[0];
    $guide = mysqli_result_to_array(mysqli_query($conn, $guide_sql))[0];
    $total_pages = mysqli_result_to_array(mysqli_query($conn, $total_page_sql))[0]["cnt"];
    $total_guides = mysqli_result_to_array(mysqli_query($conn, $total_guide_sql))[0]["cnt"];
    if($total_pages==$page_id)
        $is_last_page = 1;
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
                            <?php echo $guide["contents"] ?>
                        </div>
                        <img class="image" src='<?php echo $guide["image"] ?>'/>
                        <?php
                        if ($page_id == 1){
                            echo "<img onclick=\"location.href='/class/alivebook/guide/".$storybook_id."/".($total_guides)."'\"
                                 class=\"bbtn_left_story\" style=\"cursor: pointer;\"
                                 src=\"/img/scroll-btn(left).png\"
                                 srcset=\"/img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x\"/>";
                        }
                        else if($page_id>1){
                            echo "<img onclick=\"location.href='/class/alivebook/capture/".$storybook_id."/".($page_id-1)."'\"
                                 class=\"bbtn_left_story\" style=\"cursor: pointer;\"
                                 src=\"/img/scroll-btn(left).png\"
                                 srcset=\"/img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x\"/>";
                        }
                        if($is_last_page!=1){
                            echo "<img onclick=\"location.href='/class/alivebook/capture/".$storybook_id."/".($page_id+1)."'\"
                                 class=\"bbtn_right_story\" style=\"cursor: pointer;\"
                                 src=\"/img/scroll-btn(right).png\" 
                                 srcset=\"/img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x\"/>";
                        }else{
                            echo "<img onclick=\"location.href='/class/alivebook/play/".$storybook_id."/1'\"
                                 class=\"bbtn_right_story\" style=\"cursor: pointer;\"
                                 src=\"/img/scroll-btn(right).png\" 
                                 srcset=\"/img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x\"/>";
                        }
                        ?>
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

                        <div class="Sentence" style="cursor: pointer" onclick="location.href='/class/alivebook/play/<?php echo $storybook_id."/1"; ?>'">
                            <img class="arrow" src="/img/grayarrow_last.png" srcset="/img/grayarrow_last@2x.png 2x,
             /img/grayarrow_last@3x.png 3x" />
                            <div class="arrowtext">Play</div>
                        </div>
                    </div>
                    <div class="next next3"><span class="textDefault bold" onclick="location.href='/class/alivebook'">Story List</span></div>

                </div>
<!--                <div class="next next3"><span class="textDefault bold" onclick="location.href='/class/alivebook'">Story List</span></div>-->

        </div>
        </div>

    </div>
    <!-- content end-->
</div>
</div>

</body>


</html>
