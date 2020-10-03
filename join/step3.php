<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
?>
<!--From pages/page10 html-->
<!--Nationality Information-->
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
                        <span class="textDefault f36 bold"> Where are you from? </span>
                    </div>

                    <div class="input-form">
                        <div class="divBox10">
                            <select class="select textDefault" name="uContry" id="uContry">
                                <option value="">Select Country</option>
                                <option value="1">Jersey</option>
                                <option value="2">Kazakhstan</option>
                                <option value="3">Kenya</option>
                                <option value="4">Kiribati</option>
                                <option value="5">Korea, Democratic People's Republic
                                    of</option>
                                <option value="6">Korea Republic of</option>
                            </select>
                        </div>
                    </div>

                    <div class="next">
                        <span class="textDefault bold" onClick="contry('page11.html')">Next</span>
                    </div>

                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>