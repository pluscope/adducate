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
    $sentence = $vocab["sentence"];
    $words = explode(" ", $sentence);
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
    var totalWords = parseInt('<?php echo count($words); ?>');
    var isLast = parseInt('<?php echo $is_last_page; ?>');

    function addWord(word){
        var wordList = document.getElementById(("answer"));
        if(wordList.childElementCount < totalWords){
            var new_word = word.cloneNode();
            new_word.setAttribute("class", "wordblue whitetext");
            new_word.setAttribute("onclick", "removeWord(this)");
            new_word.innerText = word.innerText;
            wordList.appendChild(new_word);
            if((wordList.childElementCount == totalWords) && checkAnswer() && !isLast){
                location.href='/class/storybook/sentence/'+'<?php echo $storybook_id; ?>'+'/'+'<?php echo $lesson_id; ?>'+'/'+<?php echo $page_id+1; ?>
            }
        }else{
            alert("Too many word!");
        }
    }

    function removeWord(word){
        var wordList = document.getElementById(("answer"));
        wordList.removeChild(word);
    }

    function checkAnswer(){
        var wordList = document.getElementById(("answer"));
        var words = document.querySelectorAll('#answer > button');
        var sentence = '';
        var answer = '<?php echo $sentence; ?>';
        for(var i=0; i<words.length; ++i){
            sentence += words[i].innerText;
        }
        if(sentence == answer.replaceAll(" ", ""))
            return true;
        return false;
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
                        <div class="divBox25">
                            <div class="word">Make the right sentence</div>
                            <img class="wordshadow" src="/img/shadow_header.png" srcset="/img/shadow_header@2x.png 2x, /img/shadow_header@3x.png 3x" />
                            <div class="wordmeaning2" id="vocWordText">
                                <?php echo $sentence; ?>
                            </div>
                            <div class="wordselections2" id="answer">
<!--                                <button class="wordblue whitetext">Tunami</button>-->
                            </div>
                            <div class="wordselections2" id="select">
                                <?php
                                    for($i=0; $i<count($words); $i++){
                                        echo "<button class='wordblack whitetext' onclick='addWord(this)' value='".($i+1)."'>".$words[$i]."</button>";
                                    }
                                ?>
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;Tunami&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;is&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;going&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;to&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;a&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;market&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;to&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;run&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;errands&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;for&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;her&nbsp;&nbsp;</span></div>-->
<!--                                <div class="wordblack whitetext"><span class="f18">&nbsp;&nbsp;mother&nbsp;&nbsp;</span></div>-->
                            </div>
                        </div>
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

                        <div class="vocab" onclick="location.href='/class/storybook/vocab/<?php echo $storybook_id."/".$lesson_id."/1"; ?>'">
                            <img
                                    class="arrow"
                                    src="/img/grayarrow_middle.png"
                                    srcset="/img/grayarrow_middle@2x.png 2x,
             /img/grayarrow_middle@3x.png 3x"/>
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
                                    src="/img/greenarrow_last.png"
                                    srcset="/img/greenarrow_last@2x.png 2x,
             /img/greenarrow_last@3x.png 3x"/>
                            <div class="arrowtext">Sentence</div>
                        </div>
                    </div>

                    <div class="storylist"><span class="textDefault f37">Story List</span></div>

                </div>
                    <div class="next next2"><span class="textDefault bold" onclick="location.href='/class/storybook'">Story List</span></div>
            </div>
        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
