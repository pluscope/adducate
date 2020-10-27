<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT * FROM faqs";
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
                    <div class="pointer"><span>About</span><span> > FAQ</span></div>

                    <div class="divBox6">
                        <hr>
                        <?php
                            foreach ($result as $row){
                                echo "<span class=\"textDefault bold\" onclick=\"open6(this)\">".$row["question"]."</span>";
                                echo "<div class=\"divBox6_2\">";
                                echo "<div class=\"array1Div\">";
                                echo "<img src=\"/img/arrow1.png\" srcset=\"/img/arrow1@2x.png 2x, /img/arrow1@3x.png 3x\">";
                                echo "</div>";
                                echo "<span class=\"textDefault\">";
                                echo $row["answer"];
                                echo "</span>";
                                echo "</div>";
                                echo "<hr>";
                            }
                        ?>
                    </div>

                    <script>
                        function open6(x) {
                            var box = x.nextElementSibling;

                            console.log(box);
                            if (box.style.display == 'block')
                                box.style.display = 'none';
                            else
                                box.style.display = 'block';
                        }
                    </script>
                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
