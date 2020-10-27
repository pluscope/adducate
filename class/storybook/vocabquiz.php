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
$vocab_sql = "SELECT * from storybook_lesson_vocabs WHERE lesson_id=%d ORDER BY id  LIMIT %d, 1";
$vocab_sql = sprintf($vocab_sql, $lesson_id, ($page_id-1));
$sql = "SELECT count(id) as cnt from storybook_lesson_vocabs WHERE lesson_id=".$lesson_id;
$first_story_sql = "SELECT id from storybook_lesson_stories where lesson_id=%d ORDER BY id LIMIT 1";
$first_story_sql = sprintf($first_story_sql, $lesson_id);
$is_last_page = 0;
if($conn) {
    $total_vocabs = mysqli_result_to_array(mysqli_query($conn, $sql))[0]["cnt"];
    $first_story_id = mysqli_result_to_array(mysqli_query($conn, $first_story_sql))[0]["id"];
    if($total_vocabs == $page_id)
        $is_last_page = 1;
    $vocabs = mysqli_result_to_array(mysqli_query($conn, $vocab_sql));
    $vocab = $vocabs[0];
    $lessons = mysqli_result_to_array(mysqli_query($conn, $lessons_sql));
    $total_lessons = count($lessons);
    $lesson = mysqli_result_to_array(mysqli_query($conn, $lesson_sql));
    $storybook = mysqli_fetch_array(mysqli_query($conn, $storybook_sql));
    for($i=0; $i<$total_lessons; ++$i){
        $sql = "SELECT id from storybook_lesson_stories WHERE lesson_id=%d ORDER BY id LIMIT 1";
        $sql = sprintf($sql, $lessons[$i]["id"]);
        $lessons[$i]["first_story_id"] = mysqli_result_to_array(mysqli_query($conn, $sql))[0]["id"];
    }
    $random_sql = "SELECT vocab from storybook_lesson_vocabs WHERE vocab not like '%".$vocab["vocab"]."%' ORDER BY RAND() LIMIT 3";
    $random_vocabs = mysqli_result_to_array(mysqli_query($conn, $random_sql));
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page24 html-->
<!--Show Storiess-->
<html>
<body>
<script>
    $( document ).ready(function() {
        var vocabs = ['<?php echo $vocab["vocab"]; ?>', '<?php echo $random_vocabs[0]["vocab"]; ?>', '<?php echo $random_vocabs[1]["vocab"]; ?>', '<?php echo $random_vocabs[2]["vocab"]; ?>'];
        var vocabs_indices = [0, 1, 2, 3];
        vocabs_indices = shuffle(vocabs_indices);
        var i;
        for(i=0; i<4; ++i){
            var vocabList = document.getElementById("vocQueAnsList");
            if(vocabs_indices[i]==0){
                vocabList.innerHTML += "<div style='cursor:pointer;' onclick='submitAnswer(1)'>"+vocabs[vocabs_indices[i]]+"</div>";
            }else{
                vocabList.innerHTML += "<div style='cursor:pointer;' onclick='submitAnswer(0)'>"+vocabs[vocabs_indices[i]]+"</div>";
            }
        }
    });

    function shuffle(a) {
        var j, x, i;
        for (i = a.length - 1; i > 0; i--) {
            j = Math.floor(Math.random() * (i + 1));
            x = a[i];
            a[i] = a[j];
            a[j] = x;
        }
        return a;
    }

    function submitAnswer(isAnswer){
        var isLast = <?php echo $is_last_page ?>;
        if(isAnswer){
            var result = document.getElementById("resultGood");
            var box = document.getElementById("mainQuizBox");
            var timeOutFunc;
            clearTimeout(timeOutFunc);
            if(isLast){
                result.innerHTML = "Well Done";
                result.style.display = 'block';
                box.classList.add("transparent");
                document.getElementById("nextDiv").style.display = 'block';
            }else{
                result.style.display = 'block';
                box.classList.add("transparent");
                timeOutFunc = setTimeout(function() { result.style.display = 'none'; box.classList.remove("transparent"); location.href='/class/storybook/vocabquiz/'+'<?php echo $storybook_id;?>'+"/"+'<?php echo $lesson_id;?>'+"/"+'<?php echo ($page_id+1);?>';
                } , 2000);
            }
        }else{
            var result = document.getElementById("resultWrong");
            var box = document.getElementById("mainQuizBox");
            var timeOutFunc;
            clearTimeout(timeOutFunc);
            result.style.display = 'block';
            box.classList.add("transparent");
            timeOutFunc = setTimeout(function() { result.style.display = 'none'; box.classList.remove("transparent") } , 2000);
        }
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
                    <div class="pointer"><span class="hover-green" onclick="location.href='/class/'" style="cursor: pointer;">Class</span><span> > </span><span class="hover-green" onclick="location.href='/class/storybook/'" style="cursor: pointer;">Storybook</span><span> > <?php echo $storybook["title"] ?></span></div>

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
                        <div class="result" id="resultWrong" style="display: none;">
                            Try Again
                        </div>
                        <div class="result green" id="resultGood" style="display: none;">
                            Good Job
                        </div>
                        <div class="nextblue" id="nextDiv" onclick="location.href='/class/storybook/sentence/<?php echo $storybook_id."/".$lesson_id."/1"; ?>'" style="display: none; cursor: pointer;"><span class="textDefault bold whitetext">Next</span></div>
                        <div class="divBox25" id="mainQuizBox">
                            <div class="word">Fill in the blank</div>
                            <hr>
                            <div class="wordmeaning2" id="vocQue">
                                <?php
                                    if(strpos($vocab["sentence"], $vocab["vocab"]))
                                        echo str_replace($vocab["vocab"],"________",$vocab["sentence"]);
                                    else
                                        echo str_replace(strtoupper($vocab["vocab"][0]).substr($vocab["vocab"], 1),"________",$vocab["sentence"]);
                                ?>
                            </div>
                            <div class="wordselections" id="vocQueAnsList">

                            </div>
                        </div>
                    </div>

                    <div class="greenarrows textDefault whitetext">
                        <div class="story" style="cursor: pointer;" onclick="location.href='/class/storybook/story/<?php echo $storybook_id."/".$lesson_id."/".$first_story_id; ?>'">
                            <img class="arrow" src="/img/grayarrow_front.png" srcset="/img/grayarrow_front@2x.png 2x,
             /img/grayarrow_front@3x.png 3x" />
                            <div class="arrowtext">story</div>
                        </div>

                        <div class="vocab" style="cursor: pointer;" onclick="location.href='/class/storybook/vocab/<?php echo $storybook_id."/".$lesson_id."/1"; ?>'">
                            <img class="arrow" src="/img/grayarrow_middle.png" srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x" />
                            <div class="arrowtext">Vocab</div>
                        </div>

                        <div class="vocabquiz">
                            <img class="arrow" src="/img/greenarrow_middle.png" srcset="/img/greenarrow_middle@2x.png 2x,
             /img/greenarrow_middle@3x.png 3x" />
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
