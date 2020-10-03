<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
?>
<!--From pages/page8 html-->
<!--Username, name and password information-->
<html>
<body>
<script>
    function formSubmit() {
        var form = document.step1;
        var pass = document.getElementById("userPass").value;
        var passConfirm = document.getElementById("userPass1").value;
        if( $("input:checkbox[id='priChk']").is(":checked") == false ){
            alert("Privacy & Terms Checkbox should be checked.");
            return false;
        }
        if(pass.length<5) {
            alert("Password is too short");
            return false;
        }
        if(passConfirm !== pass){
            alert("Confirm password field is different from password field.");
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
            <div class="container-body">

                <div class="Background_white">
                    <div class="title-div">
						<span class="textDefault f36 bold">
							Join Adducate
						</span>
                    </div>
                    <form action="step2.php" method="post" name="step1">
                        <div class="divBox8" style="height: auto">
                            <div class="textDefault">
                                Create a username
                            </div>
                            <div class="divBox8_1">
                                <input class="textDefault" type="text" placeholder="Username" id="userNm" name="userNm">
                            </div>
                            <br>
                            <div class="textDefault">
                                Enter your name
                            </div>
                            <div class="divBox8_1">
                                <input class="textDefault" type="text" placeholder="Jane" id="firstNm" name="firstNm">
                            </div>
                            <br>
                            <div class="divBox8_1">
                                <input class="textDefault" type="text" placeholder="Doe" id="lastNm" name="lastNm">
                            </div>
                            <br>
                            <div class="textDefault">
                                Create a password
                            </div>
                            <div class="divBox8_1">
                                <input class="textDefault" type="password" placeholder="Password" id="userPass" name="userPass">
                            </div>
                            <br>
                            <div class="divBox8_1">
                                <input class="textDefault" type="password" placeholder="Confirm password" id="userPass1" name="userPass1">
                            </div>
                            <div class="divBox8_2">
                                <div class="checks">
                                    <input type="checkbox" id="priChk" name="priChk">
                                    <label class="textDefault" for="priChk">Privacy & Terms</label>
                                    <img src="../img/quest.png"  srcset="../img/quest@2x.png 2x, ../img/invalid-name@3x.png 3x">
                                </div>
                            </div>
                        </div>

                        <div class="next">
                            <span class="textDefault bold" onclick="formSubmit()">Next</span>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>