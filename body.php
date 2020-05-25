<?php
session_start();

if( isset($_GET["pageUrl"]) ){
	$_pageUrl = $_GET["pageUrl"]; 	
}
else{
	$_pageUrl =  isset($_POST["pageUrl"]) ? $_POST["pageUrl"]:"" ; //화면 명
}

$_userNm =  isset($_POST["s_userNm"]) ? $_POST["s_userNm"]:"";
$_userPass =  isset($_POST["s_userPass"]) ? $_POST["s_userPass"]:"";
$_userSex =  isset($_POST["s_userSexs"]) ? $_POST["s_userSexs"]:"";
$_userContry =  isset($_POST["s_userContry"]) ? $_POST["s_userContry"]:"";

$_userMonth =  isset($_POST["s_userMonth"]) ? $_POST["s_userMonth"]:"";
$_userYear =  isset($_POST["s_userYear"]) ? $_POST["s_userYear"]:"";

$_userEmail =  isset($_POST["s_userEmail"]) ? $_POST["s_userEmail"]:"";
$_userEmailChk =  isset($_POST["s_userEmailChk"]) ? $_POST["s_userEmailChk"]:"";

?>
<!DOCTYPE html>
<html>
<meta charset="utf-8"></meta>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> </meta>
<head>
<title>Adducate Web App</title>
<link href="style.css" rel="stylesheet"> </link>
<script src="./js/jquery-3.5.1.min.js"></script> 

<script>
$(document).ready( function() {      
	var pageList = ["menu.html","<?php echo $_pageUrl?>"];
	
	for( var i=0; i < pageList.length; i++ ){
		viewHtml( pageList[i] );
	}
	$("#temp1").html("");
}); 


function viewHtml( var1 ){
	$.ajax({
	    type : "GET", 
	    url : "pages/"+var1,
	    async : false,
	    dataType : "html",	
	    error : function(){
	        alert("통신실패!!!!");
	    },
	    success : function(Parse_data){
	    	$("#temp1").html(Parse_data);
	    	if( var1 == "menu.html" ){
	    		$("#container-menu").append( $("#temp1 .container").html() );
	    	}else{
	    		$("#container-page").append( 	$("#temp1 .container-body").html() );
	    	}
	    }
	     
	});
}

//패스워드 체크
function passCheck(var1){
	if($("#userPass").val() != $("#userPass1").val()){
		alert( "Password Error." );
	}else{
		$("#s_userNm").val($("#userNm").val());
		$("#s_userPass").val($("#userPass").val());
		goUrl(var1);
	}
}
//성별 선택
function checkOnly( var1 ){
	var obj = document.getElementsByName("userSex");
	
	for( var i=0; i < obj.length; i++ ){
		if( obj[i] == var1 ){
			$("#s_userSexs").val($("#"+obj[i].id).val());
		}
		else{
			obj[i].checked=false;
		}
	}
}

//성별 선택
function contry( var1 ){
	$("#s_userContry").val($("#uContry").val());
	goUrl(var1);
}

//년도 체크
function yearMonths( var1 ){
	$("#s_userMonth").val( $("#uMonth").val() );
	$("#s_userYear").val( $("#uYear").val() );
	goUrl(var1);
}

//이메일
function email( var1 ){
	$("#s_userEmail").val( $("#uEmail").val() );
	$("#s_userEmailChk").val( $("#uEmailChk").val() );
	goUrl(var1);
}


//페이지 이동
function goUrl(var1){
	$("#pageUrl").val( var1 );
	$("#fom").submit();
}



</script>
</head>
<body>
<div id="temp1" style="display: none"> </div>
<form method="POST" id="fom" name="fom" action="body.php">
	<input type="text" id="pageUrl" name="pageUrl"  value="<?php echo $_pageUrl;?>">
	<input type="text" id="s_userNm" name="s_userNm" 	value="<?php echo $_userNm;?>">
	<input type="text" id="s_userPass" name="s_userPass" value="<?php echo $_userPass;?>"/>
	<input type="text" id="s_userSexs" name="s_userSexs" value="<?php echo $_userSex;?>"/>
	<input type="text" id="s_userContry" name="s_userContry" value="<?php echo $_userContry;?>"/>
	<input type="text" id="s_userMonth" name="s_userMonth" value="<?php echo $_userMonth;?>"/>
	<input type="text" id="s_userYear" name="s_userYear" value="<?php echo $_userYear;?>"/>
	<input type="text" id="s_userEmail" name="s_userEmail" value="<?php echo $_userEmail;?>"/>
	<input type="text" id="s_userEmailChk" name="s_userEmailChk" value="<?php echo $_userEmailChk;?>"/>
</form>


	<div class="body">
	  	<div class="container" id="container-menu"></div>
	    <div class="container" id="container-page"></div>
	  <!-- content end -->
	  
	</div>


</body>


</html>