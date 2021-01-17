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
                    <div class="pointer pcLink"><span class="hover-green" onclick="location.href='/about/'" style="cursor: pointer;">About</span><span> > </span><span>FAQ</span></div>

                    <div class="divBox6">
                        <?php
//                        echo "<div class=\"divBox5_1\">";
                        echo "<div class=\"textDefault f36 bold\"><span>Frequently asked questions</span>";
                        ?>
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
                            $('.divBox6_2').each(function() {
                                $(this).hide()
                                //$(this).nextElementSibling.display = 'none';
                            });
                            var box = x.nextElementSibling;
                            if (box.style.display == 'block')
                                box.style.display = 'none';
                            else
                                box.style.display = 'block';
                        }
                    </script>
                        <div class="back-to-main mobileLink">
                            <br />
                            <br />
                            <img onclick="location.href='/'" style="cursor: pointer;" src="/img/scroll-top.png" srcset="/img/scroll-top@2x.png 2x,/img/scroll-top@3x.png 3x">
                            <br />
                            <br />
                        </div>
                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
