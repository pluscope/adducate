<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");

?>
<!--From pages/page9 html-->
<!--Sex Information-->
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
							What is your gender?
						</span>
                    </div>

                    <div class="input-form" >
                        <div class="divBox9 checks">

                            <input type="checkbox" id="cb1" name="userSex" onClick="checkOnly(this)" value="1">
                            <label class="textDefault" for="cb1">Female</label>

                            <input type="checkbox" id="cb2" name="userSex" onClick="checkOnly(this)" value="2" >
                            <label class="textDefault" for="cb2">Male</label>


                        </div>
                    </div>
                    <div class="next">
                        <span class="textDefault bold" onclick="goUrl('page10.html')">Next</span>
                    </div>

                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>