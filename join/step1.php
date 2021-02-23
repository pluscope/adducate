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
        var pass = document.getElementById("pw").value;
        var username = document.getElementById("userNm").value;
        var passConfirm = document.getElementById("pwConfirm").value;
        if( $("input:checkbox[id='priChk']").is(":checked") == false ){
            alert("Privacy & Terms Checkbox should be checked.");
            return false;
        }
        if(pass.length<6) {
            alert("Password is too short");
            return false;
        }
        if(passConfirm !== pass){
            alert("Confirm password field is different from password field.");
            return false;
        }
        $.ajax({
            type : "POST",
            url : "id_check.php",
            data : {username: username},
            dataType : "text",
            success : function(data){
                if(data=='ok')
                    form.submit();
                else
                    alert("This username is already taken by another user.");
            },
            error:function(request,status,error){
                alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
            }
        });

    }

    function clickTerms(){
        var popup = document.getElementById("popup_terms");
        var popup_arrow = document.getElementById("popup_terms_arrow");
        console.log(popup);
        if(popup.style.visibility == "visible"){
            popup.style.visibility = "hidden";
            popup_arrow.style.visibility = "hidden";
        }
        else{
            popup.style.visibility = "visible";
            popup_arrow.style.visibility = "visible";
        }
    }

    function hideTermsPopup(){
        document.getElementById("popup_terms").style.visibility = "hidden";
        document.getElementById("popup_terms_arrow").style.visibility = "hidden";
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
							Join Adducate
						</span>
                    </div>
                    <form action="/join/step2" method="post" name="step1">
                        <div class="divBox8" style="height: auto">
                            <div class="textDefault">
                                Create a username
                            </div>
                            <div class="divBox8_1">
                                <input class="textDefault" style="color=lightgray" type="text" placeholder="Username" id="userNm" name="userNm">
                            </div>
                            <br>
                            <div class="textDefault"">
                                Enter your name
                            </div>
                            <div class="divBox8_1">
                                <input class="textDefault" type="text" placeholder="First name" id="firstNm" name="firstNm">
                            </div>
                            <br>
                            <div class="divBox8_1">
                                <input class="textDefault" type="text" placeholder="Last name" id="lastNm" name="lastNm">
                            </div>
                            <br>
                            <div class="textDefault">
                                Create a password
                            </div>
                            <div class="divBox8_1">
                                <input class="textDefault" type="password" placeholder="Password" id="pw" name="pw">
                            </div>
                            <br>
                            <div class="divBox8_1">
                                <input class="textDefault" type="password" placeholder="Confirm password" id="pwConfirm" name="pwConfirm">
                            </div>
                            <div class="textDefault popup_terms" id="popup_terms">
                                <button type="button" style="display:block; font-size: 25px; margin-right: -20px; color:#ffa300; float: right; background-color: #ffffff; border-color: #ffffff; border-style: none;" onclick="hideTermsPopup()">
                                    X
                                </button>
                                <span style="font-size: 16px; line-height: 30px; margin: 5px; color:#00a3e0;">
                                     <br /> Website Terms
                                </span>
                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:grey">
                                     <br /> Last updated [December, 2020]
                                     <br />
                                </span>
                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    INTRODUCTION
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    <br />
                                    ADDUCATE (“we” or “us” or “our”) respects the privacy of our users (“user” or “you”). This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website ADDUCATE.net, including any other media form, media channel, mobile website, or mobile application related or connected thereto (collectively, the “Site”). Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, please do not access the site.
                                    We reserve the right to make changes to this Privacy Policy at any time and for any reason. We will alert you about any changes by updating the “Last Updated” date of this Privacy Policy. Any changes or modifications will be effective immediately upon posting the updated Privacy Policy on the Site, and you waive the right to receive specific notice of each such change or modification.
                                    You are encouraged to periodically review this Privacy Policy to stay informed of updates. You will be deemed to have been made aware of, will be subject to, and will be deemed to have accepted the changes in any revised Privacy Policy by your continued use of the Site after the date such revised Privacy Policy is posted.
                                    <br />
                                </span>
                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    COLLECTION OF YOUR INFORMATION
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    <br />
                                    We may collect information about you in a variety of ways. The information we may collect on the Site includes:
                                    <br />
                                    <br />
                                    Personal Data
                                    <br />
                                    Personally identifiable information, such as your name, shipping address, email address, and telephone number, and demographic information, such as your age, gender, hometown, and interests, that you voluntarily give to us when you choose to participate in various activities related to the Site such as online chat and message boards. You are under no obligation to provide us with personal information of any kind, however your refusal to do so may prevent you from using certain features of the Site.
                                    <br />
                                    <br />
                                    Derivative Data
                                    <br />
                                    Information our servers automatically collect when you access the Site, such as your IP address, your browser type, your operating system, your access times, and the pages you have viewed directly before and after accessing the Site. If you are using our mobile application, this information may also include your device name and type, your operating system, your phone number, your country, your likes and replies to a post, and other interactions with the application and other users via server log files, as well as any other information you choose to provide.
                                    <br />
                                    <br />
                                    Third-Party Data
                                    <br />
                                    Information from third parties, such as personal information or network friends, if you connect your account to the third party and grant the Site permission to access this information.
                                    <br />
                                    <br />
                                    Data From Contests, Giveaways, and Surveys
                                    <br />
                                    Personal and other information you may provide when entering contests or giveaways and/or responding to surveys.
                                    <br />
                                </span>
                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    USE OF YOUR INFORMATION
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    <br />
                                    Having accurate information about you permits us to provide you with a smooth, efficient, and customized experience. Specifically, we may use information collected about you via the Site to:
                                    <br />
                                    ●	Administer sweepstakes, promotions, and contests.
                                    <br />
                                    ●	Assist law enforcement and respond to subpoena.
                                    <br />
                                    ●	Compile anonymous statistical data and analysis for use internally or with third parties.
                                    <br />
                                    ●	Create and manage your account.
                                    <br />
                                    ●	Deliver targeted advertising, coupons, newsletters, and other information regarding promotions and the Site to you.
                                    <br />
                                    ●	Email you regarding your account or order.
                                    <br />
                                    ●	Enable user-to-user communications.
                                    <br />
                                    ●	Increase the efficiency and operation of the Site.
                                    <br />
                                    ●	Monitor and analyze usage and trends to improve your experience with the Site
                                    <br />
                                    ●	Notify you of updates to the Sites.
                                    <br />
                                    ●	Offer new products, services, and/or recommendations to you.
                                    <br />
                                    ●	Perform other business activities as needed.
                                    <br />
                                    ●	Prevent fraudulent transactions, monitor against theft, and protect against criminal activity.
                                    <br />
                                    ●	Process payments and refunds.
                                    <br />
                                    ●	Request feedback and contact you about your use of the Site
                                    <br />
                                    ●	Resolve disputes and troubleshoot problems.
                                    <br />
                                    ●	Respond to product and customer service requests.
                                    <br />
                                    ●	Send you a newsletter.
                                    <br />
                                    ●	Solicit support for the Site.
                                    <br />

                                </span>
                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    DISCLOSURE OF YOUR INFORMATION
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    <br />
                                    We may share information we have collected about you in certain situations. Your information may be disclosed as follows:
                                    <br />
                                    <br />
                                    By Law or to Protect Rights
                                    <br />
                                    If we believe the release of information about you is necessary to respond to legal process, to investigate or remedy potential violations of our policies, or to protect the rights, property, and safety of others, we may share your information as permitted or required by any applicable law, rule, or regulation. This includes exchanging information with other entities for fraud protection and credit risk reduction.
                                    <br />
                                    <br />
                                    Third-Party Service Providers
                                    <br />
                                    We may share your information with third parties that perform services for us or on our behalf, including payment processing, data analysis, email delivery, hosting services, customer service, and marketing assistance.
                                    <br />
                                    <br />
                                    Marketing Communications
                                    <br />
                                    With your consent, or with an opportunity for you to withdraw consent, we may share your information with third parties for marketing purposes, as permitted by law.
                                    <br />
                                    <br />
                                    Interactions with Other Users
                                    <br />
                                    If you interact with other users of the Site, those users may see your name, profile photo, and descriptions of your activity, including sending invitations to other users, chatting with other users, liking posts, following blogs.
                                    <br />
                                    <br />
                                    Online Postings
                                    <br />
                                    When you post comments, contributions or other content to the Site [or our mobile applications], your posts may be viewed by all users and may be publicly distributed outside the Site  in perpetuity.
                                    <br />
                                    <br />
                                    Third-Party Advertisers
                                    <br />
                                    We may use third-party advertising companies to serve ads when you visit the Site. These companies may use information about your visits to the Site  and other websites that are contained in web cookies in order to provide advertisements about goods and services of interest to you.
                                    <br />
                                    <br />
                                    Affiliates
                                    <br />
                                    We may share your information with our affiliates, in which case we will require those affiliates to honor this Privacy Policy. Affiliates include our parent company and any subsidiaries, joint venture partners or other companies that we control or that are under common control with us.
                                    <br />
                                    <br />
                                    Business Partners
                                    <br />
                                    We may share your information with our business partners to offer you certain products, services or promotions.
                                    <br />
                                    <br />
                                    Other Third Parties
                                    <br />
                                    We may share your information with advertisers and investors for the purpose of conducting general business analysis. We may also share your information with such third parties for marketing purposes, as permitted by law.
                                    <br />
                                    <br />
                                    Sale or Bankruptcy
                                    <br />
                                    If we reorganize or sell all or a portion of our assets, undergo a merger, or are acquired by another entity, we may transfer your information to the successor entity. If we go out of business or enter bankruptcy, your information would be an asset transferred or acquired by a third party. You acknowledge that such transfers may occur and that the transferee may decline honor commitments we made in this Privacy Policy.
                                    We are not responsible for the actions of third parties with whom you share personal or sensitive data, and we have no authority to manage or control third-party solicitations. If you no longer wish to receive correspondence, emails or other communications from third parties, you are responsible for contacting the third party directly.
                                    <br />

                                </span>
                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    TRACKING TECHNOLOGIES
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    <br />
                                    Cookies and Web Beacons
                                    <br />
                                    We may use cookies, web beacons, tracking pixels, and other tracking technologies on the Site  to help customize the Site  and improve your experience. When you access the Site, your personal information is not collected through the use of tracking technology. Most browsers are set to accept cookies by default. You can remove or reject cookies, but be aware that such action could affect the availability and functionality of the Site. You may not decline web beacons. However, they can be rendered ineffective by declining all cookies or by modifying your web browser’s settings to notify you each time a cookie is tendered, permitting you to accept or decline cookies on an individual basis.
                                    [We may use cookies, web beacons, tracking pixels, and other tracking technologies on the Site  to help customize the Site  and improve your experience. For more information on how we use cookies, please refer to our Cookie Policy posted on the Site, which is incorporated into this Privacy Policy. By using the Site, you agree to be bound by our Cookie Policy.]
                                    <br />
                                    <br />
                                    Internet-Based Advertising
                                    <br />
                                    Additionally, we may use third-party software to serve ads on the Site , implement email marketing campaigns, and manage other interactive marketing initiatives. This third-party software may use cookies or similar tracking technology to help manage and optimize your online experience with us. For more information about opting-out of interest-based ads, visit the Network Advertising Initiative Opt-Out Tool or Digital Advertising Alliance Opt-Out Tool.
                                    <br />
                                    <br />
                                    Website Analytics
                                    <br />
                                    We may also partner with selected third-party vendors such as Google Analytics and others to allow tracking technologies and remarketing services on the Site  through the use of first party cookies and third-party cookies, to, among other things, analyze and track users’ use of the Site , determine the popularity of certain content and better understand online activity. By accessing the Site, you consent to the collection and use of your information by these third-party vendors. You are encouraged to review their privacy policy and contact them directly for responses to your questions. We do not transfer personal information to these third-party vendors. However, if you do not want any information to be collected and used by tracking technologies, you can visit the third-party vendor or the Network Advertising Initiative Opt-Out Tool or Digital Advertising Alliance Opt-Out Tool.
                                    <br />
                                    You should be aware that getting a new computer, installing a new browser, upgrading an existing browser, or erasing or otherwise altering your browser’s cookies files may also clear certain opt-out cookies, plug-ins, or settings.
                                    <br />

                                </span>
                                    <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    THIRD-PARTY WEBSITES
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    <br />
                                    The Site  may contain links to third-party websites and applications of interest, including advertisements and external services, that are not affiliated with us. Once you have used these links to leave the Site, any information you provide to these third parties is not covered by this Privacy Policy, and we cannot guarantee the safety and privacy of your information. Before visiting and providing any information to any third-party websites, you should inform yourself of the privacy policies and practices (if any) of the third party responsible for that website, and should take those steps necessary to, in your discretion, protect the privacy of your information. We are not responsible for the content or privacy and security practices and policies of any third parties, including other sites, services or applications that may be linked to or from the Site.
                                    <br />
                                </span>

                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    SECURITY OF YOUR INFORMATION
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    <br />
                                   We use administrative, technical, and physical security measures to help protect your personal information. While we have taken reasonable steps to secure the personal information you provide to us, please be aware that despite our efforts, no security measures are perfect or impenetrable, and no method of data transmission can be guaranteed against any interception or other type of misuse. Any information disclosed online is vulnerable to interception and misuse by unauthorized parties. Therefore, we cannot guarantee complete security if you provide personal information.
                                    <br />
                                </span>

                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                   POLICY FOR CHILDREN
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    <br />
                                   We do not knowingly solicit information from or market to children under the age of 13. If you become aware of any data we have collected from children under age 13, please contact us using the contact information provided below.
                                    <br />
                                </span>
                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    CONTROLS FOR DO-NOT-TRACK FEATURES
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    <br />
                                    Most web browsers and some mobile operating systems include a Do-Not-Track (“DNT”) feature or setting you can activate to signal your privacy preference not to have data about your online browsing activities monitored and collected. No uniform technology standard for recognizing and implementing DNT signals has been finalized. As such, we do not currently respond to DNT browser signals or any other mechanism that automatically communicates your choice not to be tracked online. If a standard for online tracking is adopted that we must follow in the future, we will inform you about that practice in a revised version of this Privacy Policy. Most web browsers and some mobile operating systems include a Do-Not-Track (“DNT”) feature or setting you can activate to signal your privacy preference not to have data about your online browsing activities monitored and collected. If you set the DNT signal on your browser, we will respond to such DNT browser signals.
                                    <br />
                                </span>
                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    OPTIONS REGARDING YOUR INFORMATION
                                    <br />
                                </span>
                                <span style="font-size: 12px; line-height: 24px; margin: 5px; color:black">
                                    [Account Information]
                                    <br />
                                    You may at any time review or change the information in your account or terminate your account by:
                                    <br />
                                    ●	Logging into your account settings and updating your account
                                    <br />
                                    ●	Contacting us using the contact information provided below
                                    <br />
                                    Upon your request to terminate your account, we will deactivate or delete your account and information from our active databases. However, some information may be retained in our files to prevent fraud, troubleshoot problems, assist with any investigations, enforce our Terms of Use and/or comply with legal requirements.
                                    <br />
                                    <br />
                                    Emails and Communications
                                    <br />
                                    If you no longer wish to receive correspondence, emails, or other communications from us, you may opt-out by:
                                    <br />
                                    ●	Noting your preferences at the time you register your account with the Site.
                                    <br />
                                    ●	Logging into your account settings and updating your preferences.
                                    <br />
                                    ●	Contacting us using the contact information provided below.
                                    <br />
                                    If you no longer wish to receive correspondence, emails, or other communications from third parties, you are responsible for contacting the third party directly.
                                    <br />
<!--                                    <br />-->
<!--                                    CALIFORNIA PRIVACY RIGHTS-->
<!--                                    <br />-->
<!--                                    California Civil Code Section 1798.83, also known as the “Shine The Light” law, permits our users who are California residents to request and obtain from us, once a year and free of charge, information about categories of personal information (if any) we disclosed to third parties for direct marketing purposes and the names and addresses of all third parties with which we shared personal information in the immediately preceding calendar year. If you are a California resident and would like to make such a request, please submit your request in writing to us using the contact information provided below.-->
<!--                                    If you are under 18 years of age, reside in California, and have a registered account with the Site, you have the right to request removal of unwanted data that you publicly post on the Site. To request removal of such data, please contact us using the contact information provided below, and include the email address associated with your account and a statement that you reside in California. We will make sure the data is not publicly displayed on the Site, but please be aware that the data may not be completely or comprehensively removed from our systems.-->
<!--                                    <br />-->
<!--                                    <br />-->
                                    <br />
                                </span>
                                <span style="font-size: 14px; line-height: 24px; margin: 5px; color:#ffa300">
                                    <br />
                                    CONTACT US
                                    <br />
                                    If you have questions about this Privacy Policy,
                                    <br />
                                    please contact us at:
                                    <br />
                                    contact@adducate.net
                                </span>
                            </div>
                            <div class="popup_terms_arrow" id="popup_terms_arrow" style="visibility: hidden;">
                            </div>
                            <div class="divBox8_2">
                                <div class="checks">
                                    <input type="checkbox" id="priChk" name="priChk">
                                    <label class="textDefault" for="priChk">Privacy & Terms</label>

                                    <img onclick="clickTerms()" style="cursor: pointer;" src="../img/quest.png"  srcset="../img/quest@2x.png 2x, ../img/quest@3x.png 3x">
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