<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$abc_id = $_GET["abc_id"];
$phonics_contents_id = $_GET["phonics_contents_id"];
$is_last_abc = 0;
$title_sql = "SELECT title FROM abcs where id = ".$abc_id;
$abc_contents_sql = "SELECT id, contents FROM phonics_contents where abc_id = ".$abc_id;
$phonics_contents_sql = "SELECT * FROM phonics_contents where abc_id = %d and id = %d";
$phonics_contents_sql = sprintf($phonics_contents_sql, $abc_id, $phonics_contents_id);
$is_last_abc_sql = "SELECT id FROM phonics_contents where id > %d and abc_id=%d LIMIT 1";
$is_last_abc_sql = sprintf($is_last_abc_sql, $phonics_contents_id, $abc_id);
$blue_contents_id = $phonics_contents_id+1;
if($blue_contents_id == 27)
    $blue_contents_id = 0;
if($conn) {
    $abc_contents = mysqli_result_to_array(mysqli_query($conn, $abc_contents_sql));
    $title = mysqli_result_to_array(mysqli_query($conn, $title_sql))[0]["title"];
    $phonics_contents = mysqli_result_to_array(mysqli_query($conn, $phonics_contents_sql))[0];
    $is_last_abc_result = mysqli_query($conn, $is_last_abc_sql);
    if($is_last_abc_result->num_rows == 0)
        $is_last_abc = 1;
    for($i=0; $i<count($abc_contents); ++$i){
        $abc_contents[$i]["status"] = 0;
    }
    if($isLogin){
        $history_sql = "SELECT id FROM history WHERE user_id=%d and class_type_id=%d and contents_id=%d and lesson_id=%d";
        $history_sql = sprintf($history_sql, $userId, 1, $abc_id, $phonics_contents_id);
        $history_result = mysqli_query($conn, $history_sql);
        if($history_result->num_rows == 0){
            $history_insert_sql = "INSERT INTO history (user_id, class_type_id, contents_id, lesson_id) VALUES (%d, %d, %d, %d)";
            $history_insert_sql = sprintf($history_insert_sql, $userId, 1, $abc_id, $phonics_contents_id);
            mysqli_query($conn, $history_insert_sql);
        }
        $visited_contents_id = [];
        $history_check_sql = "SELECT lesson_id FROM history WHERE user_id=%d and class_type_id=%d and contents_id=%d";
        $history_check_sql = sprintf($history_check_sql, $userId, 1, $abc_id);
        $history_check_result = mysqli_query($conn, $history_check_sql);
        foreach ($history_check_result as $row){
            array_push($visited_contents_id, $row["lesson_id"]);
        }
        sort($visited_contents_id);
        $blue_contents_id = $visited_contents_id[0]+1;
        for($i=$visited_contents_id[0]+1; $i<count($abc_contents)+1; ++$i){
            if(in_array($blue_contents_id, $visited_contents_id))
                $blue_contents_id += 1;
        }
        if($blue_contents_id>count($abc_contents))
            $blue_contents_id = 0;
        for($i=0; $i<count($abc_contents); ++$i){
            if(in_array($abc_contents[$i]["id"], $visited_contents_id))
                $abc_contents[$i]["status"] = 1;
        }
    }
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page22 html-->
<!--Show All ABC contents-->
<html>
<body>
<script>
    $(document).ready(function(){

    });

    function playAbcSound(){
        document.getElementById('phonics_sound').play();
    }
    function playWordSound(){
        document.getElementById('vocabs_sound').play();
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
                    <div class="pointer"><span onclick="location.href='/class/'" class="hover-green" style="cursor: pointer;">Class</span><span> > </span><span onclick="location.href='/class/abc'" class="hover-green" style="cursor: pointer;">ABC</span><span> > </span><span class="hover-green" style="cursor: pointer;"><?php echo $title; ?></span></div>
                    <div class="abc_list" <?php if(count($abc_contents) <= 5) echo "style='left: 30%; width: 30%; transform: translateX(-100%);'" ?>>
                        <?php
                            for($i=0; $i<count($abc_contents); ++$i){
                                if($abc_contents[$i]["id"] == $phonics_contents_id){
                                    echo "<a style='color: #00a3e0; text-decoration: none;' href='/class/abc/phonics/".$abc_id."/".$abc_contents[$i]["id"]."'><span>".$abc_contents[$i]["contents"]."</span></a>";
                                }else if($abc_contents[$i]["status"]==1){
                                    echo "<a style='color: black; text-decoration: none;' href='/class/abc/phonics/".$abc_id."/".$abc_contents[$i]["id"]."'><span>".$abc_contents[$i]["contents"]."</span></a>";
                                }else if($abc_contents[$i]["status"]==0){
                                    echo "<a style='color: rgba(0, 0, 0, 0.2); text-decoration: none;' href='/class/abc/phonics/".$abc_id."/".$abc_contents[$i]["id"]."'><span>".$abc_contents[$i]["contents"]."</span></a>";
                                }
                            }
                        ?>
                      </div>
                    <div class="alphabet_box">
                        <div class="box"">
                            <?php
                                echo "<img src='".$phonics_contents["image"]."' class='img item'>";
                                echo "<audio id='phonics_sound' preload='none'>";
                                echo "<source src = '".$phonics_contents["sound"]."'>";
                                echo "</audio>";
                            ?>
                        </div>
                        <div class="box" style="width: 600px">
                            <?php
                            echo "<img src='".$phonics_contents["vocabs_image"]."' class='img item'>";
                            echo "<audio id='vocabs_sound' preload='none'>";
                            echo "<source src = '".$phonics_contents["vocabs_sound"]."'>";
                            echo "</audio>";
                            ?>
                        </div>
                    </div>

                    <div class="replay" style="cursor: pointer;  margin-left: 2%;" onclick="playAbcSound()"><span class="textDefault whitetext bold">Sound</span></div>
                    <div class="sound" style="cursor: pointer" onclick="playWordSound()"><span class="textDefault whitetext bold">Word sound</span></div>

                    <?php
                        if($is_last_abc){
//                            echo "<div class=\"next\"><span class=\"textDefault bold\" style=\"cursor: pointer\" onclick=\"location.href='/class/abc/'\">List</span></div>";
                            echo "<div class=\"next\" style=\"cursor: pointer\" onclick=\"location.href ='/class/abc/'\"><span class=\"textDefault bold\">List</span></div>";

                        }
                        else{
                            $next_abc = mysqli_fetch_array($is_last_abc_result);
//                            echo "<div class=\"next\"><span class=\"textDefault bold\" style=\"cursor: pointer\" onclick=\"location.href ='/class/abc/1/".$next_abc["id"]."'\">Next</span></div>";
                            echo "<div class=\"next\" style=\"cursor: pointer\" onclick=\"location.href ='/class/abc/phonics/".$abc_id."/".$next_abc["id"]."'\"><span class=\"textDefault bold\">Next</span></div>";
                        }
                    ?>
                </div>
            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
