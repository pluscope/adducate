<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
?>
<!--From pages/page8 html-->
<!--Username, name and password information-->
<html>
<body>
<script>
    function getStarted(){
        var userId = <?php echo $_POST["userId"];?>;
        var userNm = "<?php echo $_POST["userNm"];?>";
        $("#userId").val(userId);
        $("#userNm").val(userNm);
        document.login.submit();
    }
</script>
<div class="body">
    <div class="container" id="container-menu">
        <?php include($_SERVER["DOCUMENT_ROOT"]."/menu.php"); ?>
    </div>
    <div class="container" id="container-page">
        <!-- content start-->
        <div class="container">
            <div class="container-body-white-center">

                <div class="Background_white">

                    <div class="title-div">
						<span class="textDefault f36 bold">
							Welcome to Adducate!
						</span>
                        <br>
                        <span class="textDefault spanColor-orange bold">
							<?php echo($_POST["userNm"]);?>
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
                    <form action="/welcome_login" method="post" name="login">
                        <input type="hidden" name="userId" id="userId">
                        <input type="hidden" name="userNm" id="userNm">
                    </form>

                    <div class="next">
                        <span class="textDefault bold" onClick="getStarted()">Get Started</span>
                    </div>
                </div>
            </div>


        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>