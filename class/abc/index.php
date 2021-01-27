<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * FROM abcs";
if($conn) {
    $result = mysqli_query($conn, $sql);
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
                        foreach($result as $row){
                            echo "<div class='grid-item'>";
                            if($row["title"]=='Alphabet'){
                                echo "<div class='divBox22' style='cursor: pointer;' onclick=\"location.href='/class/abc/".$row["id"]."/1'\">";
                                echo "<div>".$row["title"]."</div>";
                                echo "</div>";
                                echo "<div class='boxdescription'>";
                                echo $row["description"];
                                echo "</div>";
                                echo "</div>";
                            }
                            else{
                                echo "<div class='divBox22' style='color: gray;'>";
                                echo "<div>".$row["title"]."</div>";
                                echo "</div>";
                                echo "<div class='boxdescription' style='color: gray;'>";
                                echo $row["description"];
                                echo "</div>";
                                echo "</div>";
                            }

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
