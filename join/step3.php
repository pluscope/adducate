<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
include_once( $_SERVER["DOCUMENT_ROOT"]."/config/db_config.php");
$sql = "SELECT id, name FROM countries";
$countries = mysqli_query($conn, $sql);
?>
<!--From pages/page10 html-->
<!--Nationality Information-->
<!--Array ( [userNm] => sihwa [firstNm] => sihwa [lastNm] => park [userPass] => sihwa [priChk] => on [userSex] => 1 )-->
<html>
<body>
<script>
    function formSubmit() {
        var form = document.step3;
        document.getElementById("userNm").value = "<?php echo $_POST['userNm'];?>"
        document.getElementById("firstNm").value = "<?php echo $_POST['firstNm'];?>"
        document.getElementById("lastNm").value = "<?php echo $_POST['lastNm'];?>"
        document.getElementById("userPass").value = "<?php echo $_POST['userPass'];?>"
        document.getElementById("priChk").value = "<?php echo $_POST['priChk'];?>"
        document.getElementById("userSex").value = "<?php echo $_POST['userSex'];?>"
        if( $("#uContry").val() === "" || $("#uContry").val() === undefined){
            alert("Choose your nationality.");
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
                        <span class="textDefault f36 bold"> Where are you from? </span>
                    </div>
                    <form action="/join/step4" method="post" name="step3">
                        <input type="hidden" placeholder="Username" id="userNm" name="userNm">
                        <input type="hidden" placeholder="Jane" id="firstNm" name="firstNm">
                        <input type="hidden" placeholder="Doe" id="lastNm" name="lastNm">
                        <input type="hidden" placeholder="Password" id="userPass" name="userPass">
                        <input type="hidden" id="priChk" name="priChk">
                        <input type="hidden" id="userSex" name="userSex">

                        <div class="input-form">
                            <div class="divBox10">
                                <select class="select textDefault" name="uContry" id="uContry">
                                    <option value="">Select Country</option>
                                    <?php
                                    foreach($countries as $country){
                                        echo("<option value='".$country["id"]."'>".$country["name"]."</option>");
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