<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$id = $_GET["id"];
$sql = "SELECT * FROM creationstories WHERE id=%d";
$sql = sprintf($sql, $id);
$GLOBALS['isLogin'] = $isLogin;
$GLOBALS['userId'] = $userId;
$GLOBALS['conn'] = $conn;
$GLOBALS['creationstory_id'] = $id;
if($conn) {
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($result);
    $GLOBALS['category'] = $result["category"];
    if($isLogin){
        $history_sql = "SELECT id FROM history WHERE user_id=%d and class_type_id=%d and contents_id=%d";
        $history_sql = sprintf($history_sql, $userId, 4, $id);
        $history_result = mysqli_query($conn, $history_sql);
        if($history_result->num_rows == 0){
            $history_insert_sql = "INSERT INTO history (user_id, class_type_id, contents_id, lesson_id) VALUES (%d, %d, %d, %d)";
            $history_insert_sql = sprintf($history_insert_sql, $userId, 4, $id, $result["category"]);
            mysqli_query($conn, $history_insert_sql);
        }
    }
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page41 html-->
<!--Show CreationStory Contents-->
<html>
<body>
<script>
    function playVideo(){
        document.getElementById('video').play();
    }
    $(document).ready( function() {
        var isLogin = '<?= $isLogin ?>';
        document.getElementById('contents_video').addEventListener('ended',whenVideoEnds,false);
        document.getElementById('contents_video').isLogin = isLogin;
    });
    function whenVideoEnds(e) {
        if( e.currentTarget.isLogin != "" ){
            $.ajax({
                type: "POST",
                url: 'add_creationstory_history.php',
                dataType: "text",
                data: {id: '<? echo $id; ?>', category: '<? echo $GLOBALS['category']; ?>'},
                success: function (obj, textstatus) {
                    console.log('history success')
                }
            });
        }
        //alert(add)
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
                    <div class="pointer"><span class="hover-green" onclick="location.href='/class/'" style="cursor: pointer;">Class</span><span> > </span><span class="hover-green" onclick="location.href='/class/creationstory/'" style="cursor: pointer;"> Creation Story</span><span> >

<!--                    <div class="pointer"><span onclick="location.href='/class/'" class="hover-green" style="cursor: pointer;">Class</span><span> > Creation Story</span><span> >-->
                            <?php
                                if($result["category"]==0)
                                    echo "Old story";
                                else if($result["category"]==1)
                                    echo "New story";
                            ?></span></div>
                    <div class="creationbox">
                        <div class="first">
                            <video id="contents_video" autoplay controls style="width: 100%; height: 100%;">
<!--                                <video id="video" style="width: 100%; height: 100%;" controls>-->
                                <?php
                                    echo "<source type='video/mp4' src='".$result["video_link"]."'></source>";
                                ?>
                                </video>
                        </div>

                        <div class="storywordbox2 textDefault">
                            <div class="sentence-div textDefault bold">Today's sentence</div>
                            <?php
                                echo $result["key_sentence"];
                            ?>
                        </div>
                    </div>
                    <div class="next next4"><span class="textDefault bold" onclick="location.href='/class/creationstory'">Story List</span></div>
                </div>
<!--                <div class="sound"><span class="textDefault whitetext bold" onclick="playVideo()" style="cursor: pointer;">Play</span></div>-->
            </div>
        </div>

    </div>
    <!-- content end-->
</div>
</div>

</body>


</html>
