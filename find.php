<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header.php");
?>
<!--From pages/page2 html-->
<!--Show All classes-->
<html>
<body>
<script>
    function find(){
        var popup = document.getElementsByClassName("popup_pw");
        var email = $("#findByEmail").val()
        var username = $("#findByUsername").val()
        if(popup[0].style.visibility == "visible")
            popup[0].style.visibility = "hidden";
        else {
            $.ajax({
                type : "POST",
                url : "/find_pw.php",
                data : {email: email, username: username},
                dataType : "text",
                success : function(data){
                    if(data=='No User')
                        alert("There is no user using this email or username.");
                    else if(data=='Error')
                        alert("There is some errors whild finding your password");
                    else{
                        document.getElementById("popup_pw_span").innerHTML = data;
                        popup[0].style.visibility = "visible";
                    }
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        }
    }
</script>
<div class="body">
    <div class="container" id="container-menu">
        <?php include($_SERVER["DOCUMENT_ROOT"]."/menu.php"); ?>
    </div>
    <div class="container" id="container-page">
        <!-- content start-->
        <div class="container">
            <div class="container-body container-expand">

                <div class="container-body-white">
                    <div class="title-div">
						<span class="textDefault f36 bold">
							Forgot Password?
						</span>
                    </div>

                    <div class="input-form">
                        <div class="textbox">
                            <input class="select textDefault" id="findByEmail" type="text" placeholder="Enter your e-mail">
                        </div>
                        <br>
                        <span class="textDefault">
							or
						</span>
                        <br><br>
                        <div class="textbox">
                            <input class="select textDefault" type="text" id="findByUsername" placeholder="Enter your username">
                        </div>
                    </div>

                    <div class="popup_pw textDefault">
						<span>
							Your password is <span class="password" id="popup_pw_span"></span>
						</span>
                    </div>

                    <div class="next" style="cursor: pointer;" onclick="find()">
                        <span class="textDefault bold">Find</span>
                    </div>
                </div>

            </div>

        </div>
        <!-- content end-->
    </div>
</div>

</body>


</html>
