<?php
function find_idx_of_array($arr, $key_name, $value){
    for($i = 0; $i < count($arr); $i++){
        if($arr[$i][$key_name] == $value){
            return $i;
        }
    }
    return -1;
}
function find_idx_of_array_storybook($arr, $storybook_id, $lesson_id){
    for($i = 0; $i < count($arr); $i++){
        for($j = 0; $j < count($arr[$i]["lessons"]); $j++){
            if($arr[$i]["id"] == $storybook_id && $arr[$i]["lessons"][$j]["id"] == $lesson_id){
                return array($i, $j);
            }
        }
    }
    return array(-1, -1);
}
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * FROM history WHERE user_id = ".$userId;
$abc_sql = "SELECT id, title FROM abcs";
$storybook_sql = "SELECT id, title FROM storybooks";
$alivebook_sql = "SELECT id, title, storybook_id FROM alivebooks";
$creationstory_sql = "SELECT id, category, chapter FROM creationstories";
if($conn) {
    $result = mysqli_query($conn, $sql);
    $abc_result = mysqli_query($conn, $abc_sql);
    $storybook_result = mysqli_query($conn, $storybook_sql);
    $alivebook_result = mysqli_query($conn, $alivebook_sql);
    $creationstory_result = mysqli_query($conn, $creationstory_sql);
    $abc_history = array();
    $abc_history["has_history"] = 0;
    $total_abc_history = 0;
    $storybook_history = array();
    $alivebook_history = array();
    $alivebook_history["has_history"] = 0;
    $creationstory_old_history = array();
    $creationstory_new_history = array();
    $creationstory_old_history["has_history"] = 0;
    $creationstory_new_history["has_history"] = 0;
    foreach($abc_result as $row){
        $temp = array();
        $temp["id"] = $row["id"];
        $temp["title"] = $row["title"];
        $temp["status"] = 0;
        $temp["last_contents_id"] = 0;
        array_push($abc_history, $temp);
    }
    foreach($storybook_result as $row){
        $temp = array();
        $temp["has_history"] = 0;
        $temp["id"] = $row["id"];
        $temp["title"] = $row["title"];
        $temp["lessons"] = array();
        $lesson_sql = "SELECT id FROM storybook_lessons WHERE storybook_id = ".$row["id"];
        $lesson_result = mysqli_query($conn, $lesson_sql);
        foreach($lesson_result as $row){
            $temp2 = array();
            $temp2["id"] = $row["id"];
            $temp2["status"] = 0;
            $first_story_sql = "SELECT id FROM storybook_lesson_stories WHERE lesson_id = %d LIMIT 1";
            $first_story_sql = sprintf($first_story_sql, $row["id"]);
            $temp2["first_story_id"] = mysqli_fetch_array(mysqli_query($conn, $first_story_sql))["id"];
            array_push($temp["lessons"], $temp2);
        }
        array_push($storybook_history, $temp);
    }
    foreach($alivebook_result as $row){
        $temp = array();
        $temp["id"] = $row["id"];
        $temp["storybook_id"] = $row["storybook_id"];
        $temp["title"] = $row["title"];
        $temp["status"] = 0;
        $first_lesson_sql = "SELECT id FROM storybook_lessons WHERE storybook_id = %d LIMIT 1";
        $first_lesson_sql = sprintf($first_lesson_sql, $row["storybook_id"]);
        $first_lesson_id = mysqli_fetch_array(mysqli_query($conn, $first_lesson_sql))["id"];
        $first_story_sql = "SELECT id FROM storybook_lesson_stories WHERE lesson_id = %d LIMIT 1";
        $first_story_sql = sprintf($first_story_sql, $first_lesson_id);
        $temp["first_story_id"] = mysqli_fetch_array(mysqli_query($conn, $first_story_sql))["id"];
        array_push($alivebook_history, $temp);
    }
    foreach($creationstory_result as $row){
        $temp = array();
        $temp["id"] = $row["id"];
        $temp["chapter"] = $row["chapter"];
        $temp["status"] = 0;
        if($row["category"]==0)
            array_push($creationstory_old_history, $temp);
        else
            array_push($creationstory_new_history, $temp);
    }

    foreach ($result as $row){
        if($row["class_type_id"]==1){
            $found_idx = find_idx_of_array($abc_history, "id", $row["contents_id"]);
            if($found_idx != -1){
                $abc_history["has_history"] = 1;
                $abc_history[$found_idx]["last_contents_id"] = $row["lesson_id"];
                if($abc_history[$found_idx]["status"] == 0){
                    $abc_history[$found_idx]["status"] = 1;
                }
                $total_abc_history += 1;
            }
        }else if($row["class_type_id"]==2){
            list($found_storybook_idx,$found_lesson_idx) = find_idx_of_array_storybook($storybook_history, $row["contents_id"], $row["lesson_id"]);
            if($found_storybook_idx != -1){
                $storybook_history[$found_storybook_idx]["has_history"] = 1;
                if($storybook_history[$found_storybook_idx]["lessons"][$found_lesson_idx]["status"] == 0){
                    $storybook_history[$found_storybook_idx]["lessons"][$found_lesson_idx]["status"] = 1;
                }else if($storybook_history[$found_storybook_idx]["lessons"][$found_lesson_idx]["status"] == 1){
                    $storybook_history[$found_storybook_idx]["lessons"][$found_lesson_idx]["status"] = 2;
                }
            }
        }else if($row["class_type_id"]==3){
            $found_idx = find_idx_of_array($alivebook_history, "id", $row["contents_id"]);
            if($found_idx != -1){
                $alivebook_history["has_history"] = 1;
                if($alivebook_history[$found_idx]["status"] == 0){
                    $alivebook_history[$found_idx]["status"] = 1;
                }else if($alivebook_history[$found_idx]["status"] == 1){
                    $alivebook_history[$found_idx]["status"] = 2;
                }
            }
        }else if($row["class_type_id"]==4){
            if($row["lesson_id"] == 0){ //old story
                $found_idx = find_idx_of_array($creationstory_old_history, "id", $row["contents_id"]);
                if($found_idx != -1){
                    $creationstory_old_history["has_history"] = 1;
                    if($creationstory_old_history[$found_idx]["status"] == 0){
                        $creationstory_old_history[$found_idx]["status"] = 1;
                    }else if($creationstory_old_history[$found_idx]["status"] == 1){
                        $creationstory_old_history[$found_idx]["status"] = 2;
                    }
                }
            }else if($row["lesson_id"] == 1){ //new story
                $found_idx = find_idx_of_array($creationstory_new_history, "id", $row["contents_id"]);
                if($found_idx != -1){
                    $creationstory_new_history["has_history"] = 1;
                    if($creationstory_new_history[$found_idx]["status"] == 0){
                        $creationstory_new_history[$found_idx]["status"] = 1;
                    }else if($creationstory_new_history[$found_idx]["status"] == 1){
                        $creationstory_new_history[$found_idx]["status"] = 2;
                    }
                }
            }
        }
    }
    //sort alivebook and creation story
    $sorted_alivebook_history = array();
    for($i=0; $i<count($alivebook_history); ++$i){
        if($alivebook_history[$i]["status"]==2){
            array_push($sorted_alivebook_history, $alivebook_history[$i]);
        }
    }
    for($i=0; $i<count($alivebook_history); ++$i){
        if($alivebook_history[$i]["status"]==1){
            array_push($sorted_alivebook_history, $alivebook_history[$i]);
        }
    }
    for($i=0; $i<count($alivebook_history); ++$i){
        if($alivebook_history[$i]["status"]==0){
            array_push($sorted_alivebook_history, $alivebook_history[$i]);
        }
    }
    $sorted_creationstory_old_history = array();
    $sorted_creationstory_new_history = array();
    for($i=0; $i<count($creationstory_old_history); ++$i){
        if($creationstory_old_history[$i]["status"]==2){
            array_push($sorted_creationstory_old_history, $creationstory_old_history[$i]);
        }
    }
    for($i=0; $i<count($creationstory_old_history); ++$i){
        if($creationstory_old_history[$i]["status"]==1){
            array_push($sorted_creationstory_old_history, $creationstory_old_history[$i]);
        }
    }
    for($i=0; $i<count($creationstory_old_history); ++$i){
        if($creationstory_old_history[$i]["status"]==0){
            array_push($sorted_creationstory_old_history, $creationstory_old_history[$i]);
        }
    }
    for($i=0; $i<count($creationstory_new_history); ++$i){
        if($creationstory_new_history[$i]["status"]==2){
            array_push($sorted_creationstory_new_history, $creationstory_new_history[$i]);
        }
    }
    for($i=0; $i<count($creationstory_new_history); ++$i){
        if($creationstory_new_history[$i]["status"]==1){
            array_push($sorted_creationstory_new_history, $creationstory_new_history[$i]);
        }
    }
    for($i=0; $i<count($creationstory_new_history); ++$i){
        if($creationstory_new_history[$i]["status"]==0){
            array_push($sorted_creationstory_new_history, $creationstory_new_history[$i]);
        }
    }
    if($total_abc_history == 26){
        $abc_history[0]["status"] = 2;
    }
}else{
    //@TODO alert message when the connection is not connected
}
?>

<title>Adducate</title>
<link href="style.css" rel="stylesheet">
<head>
    <script>
        $(document).ready( function() {
            scrollbarPosition = 0;
            function getMaxChildWidth(elm) {
                // var max = 0;
                // elm.children().each(function(){
                //     c_width = parseInt($(this).width());
                //     max += c_width;
                // });
                // return max-850;
                return elm[0].scrollWidth-750;
            }
            function getScrollingValue(toLeft, ctx) {
                //var scrollbarPosition = ctx.scrollTop();
                console.log(scrollbarPosition);
                if (toLeft) {
                    scrollbarPosition -= 100;
                    if(scrollbarPosition<0)
                        scrollbarPosition = 0
                }else{
                    scrollbarPosition += 100;
                    if(scrollbarPosition > getMaxChildWidth(ctx))
                        scrollbarPosition = getMaxChildWidth(ctx);
                }
                return scrollbarPosition;
            }
            $('.scroll-to-left').on('click', function() {
                $(this).next().scrollLeft(getScrollingValue(true, $(this).next()));
                if(scrollbarPosition==0){
                    $(this).next().next()[0].style.marginLeft = '50px';
                    $(this).hide();
                }
            });

            $('.scroll-to-right').on('click', function() {
                // console.log($(this));
                // console.log($(this)[0]);
                // console.log($(this)[0].style);
                $(this)[0].style.marginLeft = '0px';
                $(this).parent().children('.scroll-to-left').show();
                $(this).prev().scrollLeft(getScrollingValue(false, $(this).prev()));
            });

            $('.Lorem-text-overflow').each(function() {
                if($(this).children('.push')[0].scrollWidth<=840){
                    $(this).children('.scroll-to-left').hide();
                    $(this).children('.scroll-to-right').hide();
                }else{
                    $(this).children('.scroll-to-left').hide();
                }
            });
        });
    </script>
</head>
<body>
<div id="temp1" style="display: none"> </div>
<div class="body" id="mainBody">
    <div class="container" id="container-menu">
        <?php include($_SERVER["DOCUMENT_ROOT"]."/menu.php"); ?>
    </div>
    <div class="container" id="container-page">
        <!-- content start-->
        <div class="container">
            <div class="container-body container-expand">

                <div class="container-body-white-left">
                    <img onclick="goUrl('page21.html')" class="ABC" src="/img/abc.jpg" srcset="/img/abc@2x.jpg 2x,/img/abc@3x.jpg 3x" />
                    <div class="Lorem-text-overflow">
<!--                        <img class='scroll-to-left' src='/img/scroll-btn(left).png' srcset='img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x' />-->
                        <div class="push" id="abcPush">
                            <?php
                                $i=0;
                                foreach ($abc_history as $row){
                                    if(is_array($row)) {
                                        if ($row["status"] == 0) {
                                            if ($abc_history["has_history"] == 0 && $i == 0) {
                                                echo "<span style='cursor: pointer' onclick=\"location.href='/class/abc/1/1'\" class='selected'>" . $row["title"] . "</span>";
                                            } else {
                                                echo "<span>" . $row["title"] . "</span>";
                                            }
                                        } else if ($row["status"] == 1) {
                                            if ($row["id"] == 1) {
                                                echo "<span style='cursor: pointer' onclick=\"location.href='/class/abc/1/".$row["last_contents_id"]."'\" class='selected'>" . $row["title"] . "</span>";
                                            } else {
                                                echo "<span class='selected'>" . $row["title"] . "</span>";
                                            }
                                        } else if ($row["status"] == 2) {
                                            if ($row["id"] == 1) {
                                                echo "<span style='cursor: pointer; color: black;' onclick=\"location.href='/class/abc/1/26'\">" . $row["title"] . "</span>";
                                            } else {
                                                echo "<span style='color: black''>" . $row["title"] . "</span>";
                                            }
                                        }
                                        $i++;
                                    }
                                }
                            ?>
                        </div>
<!--                        <img class='scroll-to-right' src='/img/scroll-btn(right).png' srcset='img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x' />-->
                    </div>
                    <?php
                        echo "<hr>";
                        echo "<img onclick='' class='Storybook' src='/img/storybook.png' srcset='/img/storybook@2x.png 2x,/img/storybook@3x.png 3x' />";
                        foreach ($storybook_history as $row){
                            echo "<div class=\"Lorem-text-overflow\">";
//                            echo "<img class='scroll-to-left' src='/img/scroll-btn(left).png' srcset='img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x' />";
                            echo "<div class=\"push\" id=\"storyPush\">";
                            echo "<li class='myclass_blue'>";
                            echo "<span>&nbsp;&nbsp;".$row["title"]."&nbsp;&nbsp</span>";
                            echo "</li>";
                            for($i=0; $i<count($row["lessons"]); ++$i){
                                if($row["lessons"][$i]["status"]==0){
                                    if($row["has_history"]==0 && $i==0){
                                        echo "<span class='selected' style='cursor: pointer;' onclick=\"location.href='/class/storybook/story/".$row["id"]."/".$row["lessons"][$i]["id"]."/".$row["lessons"][$i]["first_story_id"]."'\">Lesson ".strval($i+1)."</span>";
                                    }else if($i>0 && $row["lessons"][$i-1]["status"]==2){
                                        echo "<span class='selected' style='cursor: pointer;' onclick=\"location.href='/class/storybook/story/".$row["id"]."/".$row["lessons"][$i]["id"]."/".$row["lessons"][$i]["first_story_id"]."'\">Lesson ".strval($i+1)."</span>";
                                    } else{
                                        echo "<span>Lesson ".strval($i+1)."</span>";
                                    }
                                }else if($row["lessons"][$i]["status"]==1){
                                    echo "<span class='selected' style='cursor: pointer;' onclick=\"location.href='/class/storybook/story/".$row["id"]."/".$row["lessons"][$i]["id"]."/".$row["lessons"][$i]["first_story_id"]."'\">Lesson ".strval($i+1)."</span>";
                                }else if($row["lessons"][$i]["status"]==2){
                                    echo "<span style='color: black; cursor: pointer;' onclick=\"location.href='/class/storybook/story/".$row["id"]."/".$row["lessons"][$i]["id"]."/".$row["lessons"][$i]["first_story_id"]."'\">Lesson ".strval($i+1)."</span>";
                                }
                            }
                            echo "</div>";
//                            echo "<img class='scroll-to-right' src='/img/scroll-btn(right).png' srcset='img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x' />";
                            echo "</div>";
                        }
                    ?>
<!--                    <div class="Lorem-text-overflow">-->
<!--                        <div class="push" id="storyPush">-->
<!--                            <span>Story 1</span>-->
<!--                            <span>Story 2</span>-->
<!--                            <span class="selected">Story 3</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <hr>-->
<!---->
<!--                    <div class="Lorem-text-overflow">-->
<!--                        <div class="push" id="storyPush">-->
<!--                            <span>Story 1</span>-->
<!--                            <span>Story 2</span>-->
<!--                            <span class="selected">Story 3</span>-->
<!--                        </div>-->
<!--                    </div>-->
                    <hr>

                    <img class="Alivebook" src="/img/alivebook.png" srcset="/img/alivebook@2x.png 2x,/img/alivebook@3x.png 3x" />
                    <div class="Lorem-text-overflow" style="overflow: scroll;">
<!--                        <img class='scroll-to-left' src='/img/scroll-btn(left).png' srcset='img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x' />-->
                        <div class="push" id="createPush">
                            <?php
                            $i=0;
                            foreach ($sorted_alivebook_history as $row){
                                if($row["status"]==0){
                                    if($alivebook_history["has_history"]==0 && $i==0){
                                        echo "<span style='cursor: pointer' onclick=\"location.href='/class/abc/1/1'\" class='selected'>".$row["title"]."</span>";
                                    }else{
                                        echo "<span>".$row["title"]."</span>";
                                    }
                                }else if($row["status"]==1){
                                    echo "<span class='selected' style='cursor: pointer;' onclick=\"location.href='/class/alivebook/read/".$row["storybook_id"]."/".$row["first_story_id"]."'\">".$row["title"]."</span>";
                                }else if($row["status"]==2){
                                    echo "<span style='color: black; cursor: pointer;' onclick=\"location.href='/class/alivebook/read/".$row["storybook_id"]."/".$row["first_story_id"]."'\">".$row["title"]."</span>";
                                }
                                $i++;
                            }
                            ?>
                        </div>
<!--                        <img class='scroll-to-right' src='/img/scroll-btn(right).png' srcset='img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x' />-->
                    </div>
                    <hr>

                    <img class="Creation-Story" src="/img/creation-story.png" srcset="/img/creation-story@2x.png 2x,/img/creation-story@3x.png 3x" />
                    <br />
                    <div class="Lorem-text-overflow" style="overflow: scroll;">
                        <div class="push" id="createPush">
                            <span class="myclass_blue" style='color: #ffffff; line-height: 1.8;'> &nbsp;&nbsp;Old Stories&nbsp;&nbsp; </span>
                        </div>
                    </div>
                    <div class="Lorem-text-overflow" style="overflow: scroll;">
<!--                        <img class='scroll-to-left' src='/img/scroll-btn(left).png' srcset='img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x' />-->
                        <div class="push" id="createPush">
                            <?php
                                $i=0;
                                foreach ($sorted_creationstory_old_history as $row){
                                    if($row["status"]==0){
                                        if($creationstory_old_history["has_history"]==0 && $i==0){
                                            echo "<span class='selected' style='cursor: pointer;' onclick=\"location.href='/class/creationstory/".$row["id"]."'\">Chapter ".$row["chapter"]."</span>";
                                        }else{
                                            echo "<span>Chapter ".$row["chapter"]."</span>";
                                        }
                                    }else if($row["status"]==1){
                                        echo "<span class='selected' style='cursor: pointer;' onclick=\"location.href='/class/creationstory/".$row["id"]."'\">Chapter ".$row["chapter"]."</span>";
                                    }else if($row["status"]==2){
                                        echo "<span style='color: black; cursor: pointer;' onclick=\"location.href='/class/creationstory/".$row["id"]."'\">Chapter ".$row["chapter"]."</span>";
                                    }
                                    $i++;
                                }
                            ?>
                        </div>
<!--                        <img class='scroll-to-right' src='/img/scroll-btn(right).png' srcset='img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x' />-->
                    </div>
                    <div class="Lorem-text-overflow" style="overflow: scroll;">
                        <div class="push"  id="createPush">
                            <span class="myclass_blue" style='color: #ffffff; line-height: 1.8;'>&nbsp;&nbsp; New Stories&nbsp;&nbsp; </span>
                        </div>
                    </div>
                    <div class="Lorem-text-overflow" style="overflow: scroll;">
<!--                        <img class='scroll-to-left' src='/img/scroll-btn(left).png' srcset='img/scroll-btn(left)@2x.png 2x,/img/scroll-btn(left)@3x.png 3x' />-->
                        <div class="push" id="createPush">
                            <?php
                            $i=0;
                                foreach ($sorted_creationstory_new_history as $row){
                                    if($row["status"]==0){
                                        if($creationstory_new_history["has_history"]==0 && $i==0){
                                            echo "<span class='selected' style='cursor: pointer;' onclick=\"location.href='/class/creationstory/".$row["id"]."'\">Chapter ".$row["chapter"]."</span>";
                                        }else{
                                            echo "<span>Chapter ".$row["chapter"]."</span>";
                                        }
                                    }else if($row["status"]==1){
                                        echo "<span class='selected' style='cursor: pointer;' onclick=\"location.href='/class/creationstory/".$row["id"]."'\">Chapter ".$row["chapter"]."</span>";
                                    }else if($row["status"]==2){
                                        echo "<span style='color: black; cursor: pointer;' onclick=\"location.href='/class/creationstory/".$row["id"]."'\">Chapter ".$row["chapter"]."</span>";
                                    }
                                    $i++;
                                }
                            ?>
                        </div>
<!--                        <img class='scroll-to-right' src='/img/scroll-btn(right).png' srcset='img/scroll-btn(right)@2x.png 2x,/img/scroll-btn(right)@3x.png 3x' />-->
                    </div>
                    <hr>
<!--                    <div class="bbtn_move">-->
<!---->
<!--                        <img class="bbtn_left_move" onclick="moveleft()" src="../img/scroll-btn(left).png" srcset="../img/scroll-btn(left)@2x.png 2x,../img/scroll-btn(left)@3x.png 3x" />-->
<!--                        <img class="bbtn_right_move" onclick="moveright()" src="../img/scroll-btn(right).png" srcset="../img/scroll-btn(right)@2x.png 2x,../img/scroll-btn(right)@3x.png 3x" />-->
<!---->
<!--                    </div>-->
                </div>

            </div>
        </div>
        <!-- content end-->
    </div>
  <!-- content end -->
  
</div>

</body>


</html>