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
$is_last_lesson = 0;
$GLOBALS['isLogin'] = $isLogin;
$GLOBALS['userId'] = $userId;
$GLOBALS['conn'] = $conn;
$GLOBALS['storybook_id'] = $storybook_id;
$GLOBALS['lesson_id'] = $lesson_id;
if($conn) {
    $total_vocabs = mysqli_result_to_array(mysqli_query($conn, $sql))[0]["cnt"];
    $first_story_id = mysqli_result_to_array(mysqli_query($conn, $first_story_sql))[0]["id"];
    if($total_vocabs == $page_id)
        $is_last_page = 1;
    $vocabs = mysqli_result_to_array(mysqli_query($conn, $vocab_sql));
    $vocab = $vocabs[0];
    $sentence = $vocab["sentence"];
    if(substr($sentence, -1) == '.'){
        $sentence = substr($sentence, 0, strlen($sentence)-1);
    }
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
    if($lessons[$total_lessons-1]["id"] == $lesson_id)
        $is_last_lesson = 1;
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
    var isLastLesson = parseInt('<?php echo $is_last_lesson; ?>');

    function addWord(word){
        var wordList = document.getElementById(("answer"));
        if(wordList.childElementCount < totalWords){
            var new_word = word.cloneNode();
            new_word.setAttribute("class", "wordblue whitetext");
            new_word.setAttribute("onclick", "removeWord(this)");
            new_word.innerText = word.innerText;
            wordList.appendChild(new_word);
            if((wordList.childElementCount == totalWords) && checkAnswer() && !isLast){
                var result = document.getElementById("resultGood");
                var box = document.getElementById("mainQuizBox");
                result.style.display = 'block';
                box.classList.add("transparent");
                timeOutFunc = setTimeout(function() {
                    result.style.display = 'none';
                    box.classList.remove("transparent");
                    location.href='/class/storybook/sentence/'+'<?php echo $storybook_id; ?>'+'/'+'<?php echo $lesson_id; ?>'+'/'+<?php echo $page_id+1; ?>
                } , 2000);
            }
            if((wordList.childElementCount == totalWords) && checkAnswer() && isLast){
                var isLogin = '<?= $isLogin ?>';

                if( isLogin != "" ){
                    var storybook = '<? echo $storybook_id; ?>';
                    var lesson = '<? echo $lesson_id; ?>';
                    console.log({storybook_id: storybook, lesson_id: lesson});
                        $.ajax({
                        type: "POST",
                        url: '/class/storybook/add_storybook_history.php',
                        dataType: "text",
                        data: {storybook_id: storybook, lesson_id: lesson},
                        success: function (obj, textstatus) {
                            console.log(obj);
                            console.log('history success')
                        }
                    });
                }

                var result = document.getElementById("resultGood");
                var box = document.getElementById("mainQuizBox");

                result.innerHTML = "Well Done";
                result.style.display = 'block';
                box.classList.add("transparent");
                if(!isLastLesson)
                    document.getElementById("nextDiv").style.display = 'block';
                else
                    document.getElementById("mainQuizBox").style.display = 'none';

            }
        }else{
            var wordList = document.getElementById(("answer"));
            while (wordList.hasChildNodes()) {
                wordList.removeChild(wordList.lastChild);
            }
            var result = document.getElementById("resultWrong");
            var box = document.getElementById("mainQuizBox");
            var timeOutFunc;
            clearTimeout(timeOutFunc);
            result.style.display = 'block';
            box.classList.add("transparent");
            timeOutFunc = setTimeout(function() { result.style.display = 'none'; box.classList.remove("transparent") } , 2000);
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
        var answer = '<?php echo str_replace("'", "\'", $sentence); ?>';
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
                    <div class="pointer"><span class="hover-green" onclick="location.href='/class/'" style="cursor: pointer;">Class</span><span> > </span><span class="hover-green" onclick="location.href='/class/storybook/'" style="cursor: pointer;"> Storybook</span><span> > <?php echo $storybook["title"] ?></span></div>

                    <div class="Lorem-text-overflow2">
                        <div class="pushStory title-div2" id="alivePush">
                            <?php
                            $current_lesson_idx = 0;
                            for($i=1; $i<=$total_lessons; ++$i){
                                if($lesson_id == $lessons[$i-1]["id"]){
                                    $current_lesson_idx = $i-1;
                                    echo "<span style=\"cursor: pointer;\" onclick=\"location.href='/class/storybook/story/".$storybook_id."/".$lessons[$i-1]["id"]."/".$lessons[$i-1]["first_story_id"]."'\" class=\"selected\">Lesson ".$i."</span>";
                                }else{
                                    echo "<span style=\"cursor: pointer;\" onclick=\"location.href='/class/storybook/story/".$storybook_id."/".$lessons[$i-1]["id"]."/".$lessons[$i-1]["first_story_id"]."'\">Lesson ".$i."</span>";
                                }
                            }

                            ?>
                        </div>
                        <hr>
                    </div>

                    <div id="story_title" class="title-div2 textDefault bold">Topic - <?php echo $lesson[0]["title"] ?></div>

                    <div class="storybox">
                        <div class="result" id="resultWrong" style="display: none;">
                            Try Again
                        </div>
                        <div class="result green" id="resultGood" style="display: none;">
                            Good Job
                        </div>
                        <?php
                            if($is_last_lesson != 1){
                                echo "<div class=\"nextblue\" id=\"nextDiv\" onclick=\"location.href='/class/storybook/story/".$storybook_id."/".$lessons[$current_lesson_idx+1]["id"]."/".$lessons[$current_lesson_idx+1]["first_story_id"]."'\" style=\"display: none; cursor: pointer;\"><span class=\"textDefault bold whitetext\">Next</span></div>";
                            }
                        ?>

                        <div class="divBox25" id="mainQuizBox">
                            <div class="word">Complete the sentence with the blocks of words</div>
                            <hr>
<!--                            <img class="wordshadow" src="/img/shadow_header.png" srcset="/img/shadow_header@2x.png 2x, /img/shadow_header@3x.png 3x" />-->
                            <div class="wordmeaning2" id="vocWordText">
                                <?php echo $sentence; ?>
                            </div>
                            <div class="wordselections2" id="answer">
                            </div>
                            <div class="wordselections2" id="select">
                                <?php
                                    $words_index = array();
                                    for($i=0; $i<count($words); $i++){
                                        $words_index[$i] = $i;
                                    }
                                    shuffle($words_index);
                                    for($i=0; $i<count($words); $i++){
                                        echo "<button class='wordblack whitetext' onclick='addWord(this)' >".$words[$words_index[$i]]."</button>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="greenarrows textDefault whitetext bold">
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
                                    class="arrow_last"
                                    src="/img/greenarrow_last.png"
                                    srcset="/img/greenarrow_last@2x.png 2x,
             /img/greenarrow_last@3x.png 3x"/>
                            <div class="arrowtext">Sentence</div>
                        </div>
                    </div>
<!---->
<!--                    <div class="storylist"><span class="textDefault f37">Story List</span></div>-->
                    <div class="next next2"><span class="textDefault bold" onclick="location.href='/class/storybook'">Story List</span></div>
                </div>

            </div>
        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
