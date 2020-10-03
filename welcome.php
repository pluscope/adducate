<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
?>
<!--From pages/page8 html-->
<!--Username, name and password information-->
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
            <div class="container-body">

                <div class="Background_white">

                    <div class="title-div">
						<span class="textDefault f36 bold">
							Welcome to Adducate!
						</span>
                        <br>
                        <span class="textDefault spanColor-orange">
							<?php echo($_GET["userNm"]);?>
						</span>
                    </div>

                    <div class="input-form1" >
                        <div class="divBox13">
							<span class="textDefault f35">
								Click “Get started” and you will be automatically logged in.
								<br>
								Enjoy the class!
							</span>
                        </div>

                    </div>
                    <div class="next">
                        <span class="textDefault bold" onClick="login_insert('fom')">Get Started</span>
                    </div>

                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>