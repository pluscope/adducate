<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * FROM abcs";
$last_contents_ids = [];
if($conn) {
    $result = mysqli_query($conn, $sql);
    $result_array = mysqli_result_to_array($result);
    if($isLogin){
        for($i=0; $i<count($result_array); ++$i){
            $history_sql = "SELECT lesson_id FROM history WHERE user_id=%d and class_type_id=%d and contents_id=%d ORDER BY created_at DESC LIMIT 1";
            $history_sql = sprintf($history_sql, $userId, 1, $result_array[$i]["id"]);
            $history_result = mysqli_query($conn, $history_sql);
            $last_contents_id = 1;
            if($history_result->num_rows == 1){
                $last_contents_id = mysqli_result_to_array($history_result)[0]["lesson_id"];
            }else{
                $phonics_sql = "SELECT * FROM phonics_contents where abc_id=%d LIMIT 1";
                $phonics_sql = sprintf($phonics_sql, $result_array[$i]["id"]);
                $phonics_result = mysqli_result_to_array(mysqli_query($conn, $phonics_sql))[0];
                $last_contents_id = $phonics_result["id"];
            }
            array_push($last_contents_ids, $last_contents_id);
        }
    }else{
        for($i=0; $i<count($result_array); ++$i){
            $phonics_sql = "SELECT * FROM phonics_contents where abc_id=%d LIMIT 1";
            $phonics_sql = sprintf($phonics_sql, $result_array[$i]["id"]);
            $phonics_result = mysqli_result_to_array(mysqli_query($conn, $phonics_sql))[0];
            array_push($last_contents_ids, $phonics_result["id"]);
        }
    }
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page22 html-->
<!--Show All ABCs-->
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
                    <div class="pointer"><span onclick="location.href='/class/'" class="hover-green" style="cursor: pointer;">Class</span><span> > </span><span onclick="location.href='/class/abc'" class="hover-green" style="cursor: pointer;">ABC</span></div>
                    <div class="grid-container">
                    <?php
                    $i=0;
                        foreach($result as $row){
                            if($row["id"]==1){
                                echo "<div class='grid-item'>";
                                echo "<div class='divBox22' style='cursor: pointer;' onclick=\"location.href='/class/abc/".$row["id"]."/".$last_contents_ids[$i]."'\">";
                                echo "<div>".$row["title"]."</div>";
                                echo "</div>";
                                echo "<div class='boxdescription'>";
                                echo "<button style='width: 100%; margin-top: 15px; border: none; background-color: #00a3e0; cursor: pointer; height: 50px; border-radius: 4px;'><a href='".$row["workbook"]."' style='font-size: 20px; text-decoration: none; color: white;' download>Workbook Download</a></button>";
                                echo "</div>";
                                echo "</div>";
                            }else{
                                echo "<div class='grid-item'>";
                                echo "<div class='divBox22' style='cursor: pointer;' onclick=\"location.href='/class/abc/phonics/".$row["id"]."/".$last_contents_ids[$i]."'\">";
                                echo "<div>".$row["title"]."</div>";
                                echo "</div>";
                                echo "<div class='boxdescription'>";
                                echo "<button style='width: 100%; margin-top: 15px; border: none; background-color: #00a3e0; cursor: pointer; height: 50px; border-radius: 4px;'><a href='".$row["workbook"]."' style='font-size: 20px; text-decoration: none; color: white;' download>Workbook Download</a></button>";
                                echo "</div>";
                                echo "</div>";
                            }
                            ++$i;
                        }
                    ?>
                    </div>
                    <div class="back-to-main">
                        <br />
                        <br />
                        <img onclick="location.href='/'" style="padding-top: 175px; cursor: pointer;" src="/img/scroll-back.png">
                        <br />
                        <br />
                    </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
