<script>
    function getElementY(query) {
        return window.pageYOffset + document.querySelector(query).getBoundingClientRect().top
    }

    function doScrolling(element, duration) {
        var startingY = window.pageYOffset
        var elementY = getElementY(element)
        // If element is close to page's bottom then window will scroll only to some position above the element.
        var targetY = document.body.scrollHeight - elementY < window.innerHeight ? document.body.scrollHeight - window.innerHeight : elementY
        var diff = targetY - startingY
        // Easing function: easeInOutCubic
        // From: https://gist.github.com/gre/1650294
        var easing = function (t) { return t<.5 ? 4*t*t*t : (t-1)*(2*t-2)*(2*t-2)+1 }
        var start

        if (!diff) return

        // Bootstrap our animation - it will get called right before next frame shall be rendered.
        window.requestAnimationFrame(function step(timestamp) {
            if (!start) start = timestamp
            // Elapsed miliseconds since start of scrolling.
            var time = timestamp - start
            // Get percent of completion in range [0, 1].
            var percent = Math.min(time / duration, 1)
            // Apply the easing.
            // It can cause bad-looking slow frames in browser performance tool, so be careful.
            percent = easing(percent)

            window.scrollTo(0, startingY + diff * percent)

            // Proceed with animation as long as we wanted it to.
            if (time < duration) {
                window.requestAnimationFrame(step)
            }
        })
    }
</script>
<div class="container">
    <!-- container-header 필수 -->

    <div class="container-header">
        <div class="log">
            <a href="/">
                <img src="/img/logo_header.png" srcset="/img/logo_header@2x.png 2x, /img/logo_header@3x.png 3x" />
            </a>
        </div>

        <div class="menu">
            <ul class="menuUl">
                <li class="menuLi"><span onclick="doScrolling('#classContainer', 1000)">Class</span></li>

                <li class="menuLi"><span onclick="doScrolling('#teamContainer', 1000)">Team</span></li>

                <li class="menuLi"><span onclick="doScrolling('#aboutContainer', 1000)">About</span></li>

                <li class="menuLiBlue"><span>Download</span></li>

                <li class="menuLiSignIn" onclick="myFunction()" id="signIn"><a>Sign in</a></li>
                <li class="menuLiSignIn" onclick="myFunction1()" style="display: none" id="logout"><a></a></li>
<!--                <li class="menuLiID" onclick="myFunction1()" style="display: none" id="logout"><a></a></li>-->

            </ul>
        </div>
        <div class="popup" id="popup" style="position: absolute;">
            <input class="textbox1" type="text" placeholder="ID"  id="userId"/>
            <input class="textbox2" type="password" placeholder="PW"  id="userPass"/>
            <div class="content">
                <span class="join"><a href="/join/step1">Join</a></span>
                <span class="id_pw"><a href="/find">Find ID/PW</a></span>
                <span class="ok"><a href="#" onclick="menuLogin()">OK</a></span>
            </div>
        </div>
        <div class="popup_account" style="position: absolute;" >

            <div class="content_account">
                <span class="myclass"><a href="body.php?pageUrl=page20.html">My class</a></span>
                <span class="signout"><a href="/logout">Sign out</a></span>
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