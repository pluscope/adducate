<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
?>
<!--From pages/page12 html-->
<!--Email Information-->
<html>
<body>
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
							What is your e-mail?
						</span>
                    </div>

                    <div class="input-form" >
                        <div class="divBox12_1">
                            <input class="select textDefault" type="text" placeholder="Enter your e-mail address" id="uEmail" name="uEmail">
                        </div>
                        <div class="divBox12_2 checks">
                            <input type="checkbox" id="uEmailChk" name="uEmailChk">
                            <label for="uEmailChk" class="textDefault">If you don’t have an e-mail, check the box and click next.</label>
                        </div>
                    </div>
                    <div class="next">
                        <span class="textDefault bold" onClick="email1('page13.html')">Next</span>
                    </div>

                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>