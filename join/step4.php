<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
?>
<!--From pages/page11 html-->
<!--Born Month and Date Information-->
<html>
<body>
<script>
    function formSubmit() {
        var form = document.step4;
        document.getElementById("userNm").value = "<?php echo $_POST['userNm'];?>"
        document.getElementById("firstNm").value = "<?php echo $_POST['firstNm'];?>"
        document.getElementById("lastNm").value = "<?php echo $_POST['lastNm'];?>"
        document.getElementById("pw").value = "<?php echo $_POST['pw'];?>"
        document.getElementById("priChk").value = "<?php echo $_POST['priChk'];?>"
        document.getElementById("userSex").value = "<?php echo $_POST['userSex'];?>"
        document.getElementById("uCountry").value = "<?php echo $_POST['uCountry'];?>"
        if( $("#uMonth").val() === "" || $("#uMonth").val() === undefined){
            alert("Choose the month that you are born.");
            return false;
        }
        if( $("#uYear").val() === "" || $("#uYear").val() === undefined){
            alert("Choose the year that you are born.");
            return false;
        }
        form.submit();

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
						<span class="textDefault bold f36">
							When were you born?
						</span>
                    </div>
                    <form action="/join/step5" method="post" name="step4">
                        <input type="hidden" placeholder="Username" id="userNm" name="userNm">
                        <input type="hidden" placeholder="Jane" id="firstNm" name="firstNm">
                        <input type="hidden" placeholder="Doe" id="lastNm" name="lastNm">
                        <input type="hidden" placeholder="Password" id="pw" name="pw">
                        <input type="hidden" id="priChk" name="priChk">
                        <input type="hidden" id="userSex" name="userSex">
                        <input type="hidden" id="uCountry" name="uCountry">

                        <div class="input-form" >
                            <div class="divBox11_1">
                                <select class="monthSel textDefault" id="uMonth" name="uMonth">
                                    <option value="" selected>Month</option>
                                    <?php
                                    for($i=1; $i<=12; ++$i){
                                        echo("<option value='".$i."'>".$i."</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="divBox11_2">
                                <select class="yearSel textDefault"  id="uYear" name="uYear">
                                    <option value="" selected>Year</option>
                                    <?php
                                    for($i=1940; $i<=2020; ++$i){
                                        echo("<option value='".$i."'>".$i."</option>");
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="next">
                        <span class="textDefault bold" onClick="formSubmit()">Next</span>
                    </div>

                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>