<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * from class_manuals as cm LEFT JOIN classes c ON cm.id = c.id";
if($conn) {
    $result = mysqli_query($conn, $sql);
}else{
    //@TODO alert message when the connection is not connected
}
?>
<!--From pages/page2 html-->
<!--Show All classes-->
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
                        <div class="pointer"><span class="hover-green" onclick="location.href='/about/" style="cursor: pointer;">About</span><span> > </span>Class Manual</span></div>
                    <?php
                        foreach($result as $row){
                            echo "<div class=\"divBox5_1\">";
                            echo "<span class=\"textDefault f36 bold\">".$row["name"]."</span>";
                            echo "<br />";
                            echo "<span class=\"textDefault\">".$row["description"]."</span>";
                            echo "</div>";
                            echo "<div class=\"divBox5_2\">";
                            echo "<div class=\"video-class\"></div>";
                            echo "<div class=\"textDefault\">";
                            echo $row["contents"];
                            echo "</div>";
                            echo "</div>";
                        }
                    ?>
                        <br />
                        <br />
                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
