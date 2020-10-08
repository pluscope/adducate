<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * FROM storybooks";
if($conn) {
    $result = mysqli_query($conn, $sql);
    $first_lesson_ids = array();
    $first_story_ids = array();
    $i = 0;
    foreach($result as $row){
        $first_lesson_sql = "SELECT id FROM storybook_lessons WHERE storybook_id = %d LIMIT 1";
        $first_lesson_sql = sprintf($first_lesson_sql, $row["id"]);
        $first_lesson_ids[$i] = mysqli_fetch_array(mysqli_query($conn, $first_lesson_sql))["id"];
        $first_story_sql = "SELECT id FROM storybook_lesson_stories WHERE lesson_id = %d LIMIT 1";
        $first_story_sql = sprintf($first_story_sql, $first_lesson_ids[$i]);
        $first_story_ids[$i] = mysqli_fetch_array(mysqli_query($conn, $first_story_sql))["id"];
        ++$i;
    }
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page23 html-->
<!--Show All Storybooks-->
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
                    <div class="pointer"><span>Class</span><span> > Storybook</span></div>
                    <div class="grid-container" id="viewList">
                        <?php
                            $i = 0;
                            foreach($result as $row){
                                echo "<div class='grid-item2' style='cursor: pointer;' onclick=\"location.href='/class/storybook/story/".$row["id"]."/".$first_lesson_ids[$i]."/".$first_story_ids[$i]."'\">";
                                echo "<div class='divBox23'>";
                                echo "<img src='".$row["title_image"]."' style='max-width: 100%; max-height: 100%'>";
                                echo "</div>";
                                echo "<div class='boxtitle textDefault bold'>";
                                echo $row["title"];
                                echo "</div>";
                                echo "<div class='boxdescription2'>";
                                echo $row["description"];
                                echo "</div>";
                                echo "</div>";
                                $i++;
                            }
                        ?>
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
