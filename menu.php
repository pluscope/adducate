<div class="container">
    <!-- container-header 필수 -->

    <div class="container-header">
        <div class="log">
            <a href="/">
                <img src="../img/logo_header.png" srcset="../img/logo_header@2x.png 2x, ../img/logo_header@3x.png 3x" />
            </a>
        </div>

        <div class="menu">
            <ul class="menuUl">
                <li class="menuLi"><span onclick="goUrl('page5.html')">Class</span></li>

                <li class="menuLi"><span >Team</span></li>

                <li class="menuLi"><span onclick="goUrl('page6.html')">About</span></li>

                <li class="menuLiBlue"><span>Download</span></li>

                <li class="menuLiSignIn" onclick="myFunction()" id="loginIn"><a>Sign in</a></li>
                <li class="menuLiID" onclick="myFunction1()" style="display: none" id="loginOut"><a></a></li>

            </ul>
        </div>
        <div class="popup" id="popup" style="position: absolute;">
            <input class="textbox1" type="text" placeholder="ID"  id="m_id"/>
            <input class="textbox2" type="password" placeholder="PW"  id="m_pass"/>
            <div class="content">
                <span class="join"><a href="/join/step1">Join</a></span>
                <span class="id_pw"><a href="body.php?pageUrl=page18.html">Find ID/PW</a></span>
                <span class="ok"><a href="#" onclick="menuLogin()">OK</a></span>
            </div>
        </div>
        <div class="popup_account" style="position: absolute;margin-top:65px" >

            <div class="content_account">
                <span class="join"><a href="body.php?pageUrl=page20.html">My class</a></span>
                <span class="id_pw"><a href="/loginOut.php">Sign out</a></span>
            </div>
        </div>

        <script>
            function myFunction() {
                var popup = document.getElementsByClassName("popup");
                if(popup[0].style.visibility == "visible")
                    popup[0].style.visibility = "hidden";
                else {
                    popup[0].style.visibility = "visible";
                }
            }

            function myFunction1() {
                var popup = document.getElementsByClassName("popup_account");
                if(popup[0].style.visibility == "visible"){
                    popup[0].style.visibility = "hidden";
                }else {
                    popup[0].style.visibility = "visible";
                }

            }
        </script>

    </div>
</div>