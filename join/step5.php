<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
?>
<!--From pages/page12 html-->
<!--Email Information-->
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
        document.getElementById("uYear").value = "<?php echo $_POST['uYear'];?>"
        document.getElementById("uMonth").value = "<?php echo $_POST['uMonth'];?>"
        if( $("input:checkbox[id='uEmailChk']").is(":checked") == false && $("#uEmail").val() === ""){
            alert("Type your email. If you don't have your email, check the box.");
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
						<span class="textDefault f36 bold">
							What is your e-mail?
						</span>
                    </div>
                    <form action="/join/join" method="post" name="step4">
                        <input type="hidden" placeholder="Username" id="userNm" name="userNm">
                        <input type="hidden" placeholder="Jane" id="firstNm" name="firstNm">
                        <input type="hidden" placeholder="Doe" id="lastNm" name="lastNm">
                        <input type="hidden" placeholder="Password" id="pw" name="pw">
                        <input type="hidden" id="priChk" name="priChk">
                        <input type="hidden" id="userSex" name="userSex">
                        <input type="hidden" id="uCountry" name="uCountry">
                        <input type="hidden" id="uMonth" name="uMonth">
                        <input type="hidden" id="uYear" name="uYear">

                        <div class="input-form" >
                            <div class="divBox12_1">
                                <input class="select textDefault" type="text" placeholder="Enter your e-mail address" id="uEmail" name="uEmail">
                            </div>
                            <div class="divBox12_2 checks">
                                <input type="checkbox" id="uEmailChk" name="uEmailChk">
                                <label for="uEmailChk" class="textDefault">If you don’t have an e-mail, check the box and click next.</label>
                            </div>
                        </div>
                    </form>

                    <div class="next" onclick="formSubmit()">
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