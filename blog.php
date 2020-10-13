<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
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

                <div class="container-body-white">
                    <div class="pointer"><span>About</span><span> > Class Manual</span></div>

                    <div class="divBox5_1">
                        <span class="textDefault f36 bold">Class Manual</span>

                        <br/>

                        <span class="textDefault">Vivamus eu malesuada sapien.</span>
                    </div>

                    <div class="divBox5_2">
                        <div class="video-class"></div>

                        <div class="textDefault">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus gravida, mi quis
                            finibus venenatis , est velit congue odio, at pellentesque odio mauris vel nulla.
                            Vestibulum venenatis tempus facilisis. Vivamus eu malesuada sapien. Fusce lobortis metus
                            vel nulla eleifend.
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
