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
$alivebook_sql = "SELECT id, title FROM alivebooks";
$creationstory_sql = "SELECT id, category, chapter FROM creationstories";
if($conn) {
    $result = mysqli_query($conn, $sql);
    $abc_result = mysqli_query($conn, $abc_sql);
    $storybook_result = mysqli_query($conn, $storybook_sql);
    $alivebook_result = mysqli_query($conn, $alivebook_sql);
    $creationstory_result = mysqli_query($conn, $creationstory_sql);
    $abc_history = array();
    $storybook_history = array();
    $alivebook_history = array();
    $creationstory_old_history = array();
    $creationstory_new_history = array();
    foreach($abc_result as $row){
        $temp = array();
        $temp["id"] = $row["id"];
        $temp["title"] = $row["title"];
        $temp["status"] = 0;
        array_push($abc_history, $temp);
    }
    foreach($storybook_result as $row){
        $temp = array();
        $temp["id"] = $row["id"];
        $temp["title"] = $row["title"];
        $temp["lessons"] = array();
        $lesson_sql = "SELECT id FROM storybook_lessons WHERE storybook_id = ".$row["id"];
        $lesson_result = mysqli_query($conn, $lesson_sql);
        foreach($lesson_result as $row){
            $temp2 = array();
            $temp2["id"] = $row["id"];
            $temp2["status"] = 0;
            array_push($temp["lessons"], $temp2);
        }
        array_push($storybook_history, $temp);
    }
    foreach($alivebook_result as $row){
        $temp = array();
        $temp["id"] = $row["id"];
        $temp["title"] = $row["title"];
        $temp["status"] = 0;
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
                if($abc_history[$found_idx]["status"] == 0){
                    $abc_history[$found_idx]["status"] = 1;
                }else if($abc_history[$found_idx]["status"] == 1){
                    $abc_history[$found_idx]["status"] = 2;
                }
            }
        }else if($row["class_type_id"]==2){
            list($found_storybook_idx,$found_lesson_idx) = find_idx_of_array_storybook($storybook_history, $row["contents_id"], $row["lesson_id"]);
            if($found_storybook_idx != -1){
                if($storybook_history[$found_storybook_idx]["lessons"][$found_lesson_idx]["status"] == 0){
                    $storybook_history[$found_storybook_idx]["lessons"][$found_lesson_idx]["status"] = 1;
                }else if($storybook_history[$found_storybook_idx]["lessons"][$found_lesson_idx]["status"] == 1){
                    $storybook_history[$found_storybook_idx]["lessons"][$found_lesson_idx]["status"] = 2;
                }
            }
        }else if($row["class_type_id"]==3){
            $found_idx = find_idx_of_array($alivebook_history, "id", $row["contents_id"]);
            if($found_idx != -1){
                if($alivebook_history[$found_idx]["status"] == 0){
                    $alivebook_history[$found_idx]["status"] = 1;
                }else if($abc_history[$found_idx]["status"] == 1){
                    $alivebook_history[$found_idx]["status"] = 2;
                }
            }
        }else if($row["class_type_id"]==4){
            if($row["lesson_id"] == 0){ //old story
                $found_idx = find_idx_of_array($creationstory_old_history, "id", $row["contents_id"]);
                if($found_idx != -1){
                    if($creationstory_old_history[$found_idx]["status"] == 0){
                        $creationstory_old_history[$found_idx]["status"] = 1;
                    }else if($creationstory_old_history[$found_idx]["status"] == 1){
                        $creationstory_old_history[$found_idx]["status"] = 2;
                    }
                }
            }else if($row["lesson_id"] == 1){ //new story
                $found_idx = find_idx_of_array($creationstory_new_history, "id", $row["contents_id"]);
                if($found_idx != -1){
                    if($creationstory_new_history[$found_idx]["status"] == 0){
                        $creationstory_new_history[$found_idx]["status"] = 1;
                    }else if($creationstory_new_history[$found_idx]["status"] == 1){
                        $creationstory_new_history[$found_idx]["status"] = 2;
                    }
                }
            }
        }
    }
}else{
    //@TODO alert message when the connection is not connected
}
?>

<title>Adducate</title>
<link href="style.css" rel="stylesheet">
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
                        <div class="push" id="abcPush">
                            <?php
                                foreach ($abc_history as $row){
                                    if($row["status"]==0){
                                        echo "<span>".$row["title"]."</span>";
                                    }else if($row["status"]==1){
                                        echo "<span class='selected'>".$row["title"]."</span>";
                                    }else if($row["status"]==2){
                                        echo "<span style='color: black'>".$row["title"]."</span>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                        echo "<hr>";
                        echo "<img onclick='' class='Storybook' src='/img/storybook.png' srcset='/img/storybook@2x.png 2x,/img/storybook@3x.png 3x' />";
                        echo "<br />";
                        foreach ($storybook_history as $row){
                            echo "<span>".$row["title"]."</span>";
                            echo "<div class=\"Lorem-text-overflow\">";
                            echo "<div class=\"push\" id=\"storyPush\">";
                            for($i=0; $i<count($row["lessons"]); ++$i){
                                if($row["lessons"][$i]["status"]==0){
                                    echo "<span>Lesson ".strval($i+1)."</span>";
                                }else if($row["lessons"][$i]["status"]==1){
                                    echo "<span class='selected'>Lesson ".strval($i+1)."</span>";
                                }else if($row["lessons"][$i]["status"]==2){
                                    echo "<span style='color: black'>Lesson ".strval($i+1)."</span>";
                                }
                            }
                            echo "</div>";
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
                        <?php
                            foreach ($alivebook_history as $row){
                                if($row["status"]==0){
                                    echo "<span>".$row["title"]."</span>";
                                }else if($row["status"]==1){
                                    echo "<span class='selected'>".$row["title"]."</span>";
                                }else if($row["status"]==2){
                                    echo "<span style='color: black'>".$row["title"]."</span>";
                                }
                            }
                        ?>
                    </div>
                    <hr>

                    <img class="Creation-Story" src="/img/creation-story.png" srcset="/img/creation-story@2x.png 2x,/img/creation-story@3x.png 3x" />
                    <br />
                    <span>Old Stories</span>
                    <div class="Lorem-text-overflow" style="overflow: scroll;">
                        <div class="push" id="createPush">
                            <?php
                                foreach ($creationstory_old_history as $row){
                                    if($row["status"]==0){
                                        echo "<span>Chapter ".$row["chapter"]."</span>";
                                    }else if($row["status"]==1){
                                        echo "<span class='selected'>Chapter ".$row["chapter"]."</span>";
                                    }else if($row["status"]==2){
                                        echo "<span style='color: black'>Chapter ".$row["chapter"]."</span>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <span>New Stories</span>
                    <div class="Lorem-text-overflow" style="overflow: scroll;">
                        <div class="push" id="createPush">
                            <?php
                                foreach ($creationstory_new_history as $row){
                                    if($row["status"]==0){
                                        echo "<span>Chapter ".$row["chapter"]."</span>";
                                    }else if($row["status"]==1){
                                        echo "<span class='selected'>Chapter ".$row["chapter"]."</span>";
                                    }else if($row["status"]==2){
                                        echo "<span style='color: black'>Chapter ".$row["chapter"]."</span>";
                                    }
                                }
                            ?>
                        </div>
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