<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * FROM alivebooks";
if($conn) {
    $result = mysqli_query($conn, $sql);
    $first_lesson_ids = array();
    $first_story_ids = array();
    $i = 0;
    foreach($result as $row){
        $storybook_id = $row["storybook_id"];
        $first_lesson_sql = "SELECT id FROM storybook_lessons WHERE storybook_id = %d LIMIT 1";
        $first_lesson_sql = sprintf($first_lesson_sql, $storybook_id);
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
<!--From pages/page34 html-->
<!--Show All Alivebooks-->
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
                    <div class="pointer"><span onclick="location.href='/class/'" class="hover-green" style="cursor: pointer;">Class</span><span> > </span><span onclick="location.href='/class/alivebook/'" class="hover-green" style="cursor: pointer;">Alivebook</span></div>

<!--                    <div class="pointer"><span onclick="location.href='/class/'" class="hover-green" style="cursor: pointer;">Class</span><span> > Alivebook</span></div>-->
                    <div class="alivebookparagraph textDefault">
                        Apply students’ imagination into the stories that they read previously in the "Storybook" and then make their own storybook from drawings.
                    </div>
                    <div class="grid-container">
                        <?php
                        $i = 0;
                        foreach($result as $row){
                            echo "<div class='grid-item2' style='cursor: pointer;' onclick=\"location.href='/class/alivebook/read/".$row["storybook_id"]."/".$first_story_ids[$i]."'\">";
                            echo "<div class=\"divBox23\" style=\"background-image: url('".$row["image"]."'); background-position: center center; background-repeat: no-repeat; background-size: 100% auto;'\">";
                            echo "</div>";
                            echo "<div class='boxtitle textDefault bold'>";
                            echo $row["title"];
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
