<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
?>
<!--From pages/page11 html-->
<!--Born Month and Date Information-->
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
						<span class="textDefault bold f36">
							When were you born?
						</span>
                    </div>

                    <div class="input-form" >
                        <div class="divBox11_1">
                            <select class="monthSel textDefault" id="uMonth" name="uMonth">
                                <option value="1">Month</option>
                                <option value="2">January </option>
                                <option value="3">February</option>
                                <option value="4">March</option>
                                <option value="5">April</option>
                                <option value="6">May</option>
                                <option value="7">June</option>
                                <option value="8">July</option>
                            </select>
                        </div>
                        <div class="divBox11_2">
                            <select class="yearSel textDefault"  id="uYear" name="uYear">
                                <option>Year</option>
                                <option value="1">2000</option>
                                <option value="2">2001</option>
                                <option value="3">2002</option>
                                <option value="4">2003</option>
                                <option value="5">2004</option>
                                <option value="6">2005</option>
                                <option value="7">2006</option>
                            </select>
                        </div>
                    </div>
                    <div class="next">
                        <span class="textDefault bold" onClick="yearMonths('page12.html')">Next</span>
                    </div>

                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>