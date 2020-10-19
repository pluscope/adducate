<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * FROM creationstories";
$category = -1;
if(isset($_GET["category"])){
    $category = $_GET["category"];
    $sql = "SELECT * FROM creationstories WHERE category=%d";
    $sql = sprintf($sql, $_GET["category"]);
}
if($conn) {
    $result = mysqli_query($conn, $sql);
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page35 html-->
<!--Show All CreationStories-->
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
                    <div class="pointer"><span>Class</span><span> > Creation Story</span></div>
                    <div class="Lorem-text-overflow2">
                        <div class="push" id="alivePush">
                            <?php
                                if($category==-1){
                                    echo "<span class='selected' style='cursor: pointer;' onclick=\"location.href='/class/creationstory/'\">All</span>";
                                    echo "<span style='cursor: pointer;' onclick=\"location.href='/class/creationstory/old'\">Old Story</span>";
                                    echo "<span style='cursor: pointer;' onclick=\"location.href='/class/creationstory/new'\">New Story</span>";
                                }else if($category==0){
                                    echo "<span style='cursor: pointer;' onclick=\"location.href='/class/creationstory/'\">All</span>";
                                    echo "<span style='cursor: pointer;' class='selected' onclick=\"location.href='/class/creationstory/old'\">Old Story</span>";
                                    echo "<span style='cursor: pointer;' onclick=\"location.href='/class/creationstory/new'\">New Story</span>";
                                }else if($category==1){
                                    echo "<span style='cursor: pointer;' onclick=\"location.href='/class/creationstory/'\">All</span>";
                                    echo "<span style='cursor: pointer;' onclick=\"location.href='/class/creationstory/old'\">Old Story</span>";
                                    echo "<span style='cursor: pointer;' class='selected' onclick=\"location.href='/class/creationstory/new'\">New Story</span>";
                                }
                            ?>
                        </div>
                        <hr>
                    </div>
                    <div class="grid-container">
                        <?php
                        foreach($result as $row){
                            echo "<div class='grid-item2' style='cursor: pointer;' onclick=\"location.href='/class/creationstory/".$row["id"]."'\">";
                            echo "<div class='divBox23' style='overflow: hidden;'>";
                            echo "<img src='".$row["image"]."' style='width: -webkit-fill-available; max-height: 100%;' />";
                            echo "</div>";
                            echo "<div class=\"boxtitle textDefault bold\">";
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
