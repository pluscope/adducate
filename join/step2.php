<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");

?>
<!--From pages/page9 html-->
<!--Sex Information-->
<html>
<body>
<script>
    function formSubmit() {
        var form = document.step2;
        document.getElementById("userNm").value = "<?php echo $_POST['userNm'];?>"
        document.getElementById("firstNm").value = "<?php echo $_POST['firstNm'];?>"
        document.getElementById("lastNm").value = "<?php echo $_POST['lastNm'];?>"
        document.getElementById("userPass").value = "<?php echo $_POST['userPass'];?>"
        document.getElementById("priChk").value = "<?php echo $_POST['priChk'];?>"
        if( $("input:checkbox[id='cb1']").is(":checked") == false && $("input:checkbox[id='cb2']").is(":checked") == false){
            alert("Choose your sex.");
            return false;
        }
        if( $("input:checkbox[id='cb1']").is(":checked") == true && $("input:checkbox[id='cb2']").is(":checked") == true){
            alert("You can only choose one sex.");
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
							What is your gender?
						</span>
                    </div>
                    <form action="step3.php" method="post" name="step2">
                        <div class="input-form" >
                            <div class="divBox9 checks">
                                <input type="hidden" placeholder="Username" id="userNm" name="userNm">
                                <input type="hidden" placeholder="Jane" id="firstNm" name="firstNm">
                                <input type="hidden" placeholder="Doe" id="lastNm" name="lastNm">
                                <input type="hidden" placeholder="Password" id="userPass" name="userPass">
                                <input type="hidden" id="priChk" name="priChk">

                                <input type="checkbox" id="cb1" name="userSex" onClick="checkOnly(this)" value="1">
                                <label class="textDefault" for="cb1">Female</label>

                                <input type="checkbox" id="cb2" name="userSex" onClick="checkOnly(this)" value="2" >
                                <label class="textDefault" for="cb2">Male</label>
                            </div>
                        </div>
                    </form>

                    <div class="next">
                        <span class="textDefault bold" onclick="formSubmit()">Next</span>
                    </div>

                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>