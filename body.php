<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config.php");

$_pageUrl =  isset($_GET["pageUrl"]) ? $_GET["pageUrl"]:"" ; //화면 명

$_loginYn =  isset($_SESSION["M_NAME"])?$_SESSION["M_NAME"]:"";


if( $_pageUrl == ""){
    $_pageUrl =  isset($_GET["pageUrl"]) ? $_GET["pageUrl"]:"" ; //화면 명
}



$_userNm =  isset($_GET["s_userNm"]) ? $_GET["s_userNm"]:"";
$_userPass =  isset($_GET["s_userPass"]) ? $_GET["s_userPass"]:"";
$_userSex =  isset($_GET["s_userSexs"]) ? $_GET["s_userSexs"]:"";
$_userContry =  isset($_GET["s_userContry"]) ? $_GET["s_userContry"]:"";

$_userMonth =  isset($_GET["s_userMonth"]) ? $_GET["s_userMonth"]:"";
$_userYear =  isset($_GET["s_userYear"]) ? $_GET["s_userYear"]:"";

$_userEmail =  isset($_GET["s_userEmail"]) ? $_GET["s_userEmail"]:"";
$_userEmailChk =  isset($_GET["s_userEmailChk"]) ? $_GET["s_userEmailChk"]:"";
$_no =  isset($_GET["no"]) ? $_GET["no"]:"";
$_s_index1 =  isset($_GET["s_index1"]) ? $_GET["s_index1"]:"";
$_s_index2 =  isset($_GET["s_index2"]) ? $_GET["s_index2"]:"";
?>
<!DOCTYPE html>
<html>

<head>
<title>Adducate Web App</title>
<link href="style.css" rel="stylesheet"> </link>
<link href="/stylesheets/menu.css" rel="stylesheet"></link>

<script>
var logSession = "<?= $_loginYn ?>";
//영상 플레이용 키
var playVal = "a";
var playCnt = 2;

$(document).ready( function() {      
	var pageList = ["menu.html","<?php echo $_pageUrl?>"];
	
	for( var i=0; i < pageList.length; i++ ){
		viewHtml( pageList[i] );
	}

	$("#pageUrl").val("<?php echo $_pageUrl;?>");
	$("#s_userNm").val("<?php echo $_userNm;?>");
	$("#s_userPass").val("<?php echo $_userPass;?>");
	$("#s_userSexs").val("<?php echo $_userSex;?>");
	$("#s_userContry").val("<?php echo $_userContry;?>");
	$("#s_userMonth").val("<?php echo $_userMonth;?>");
	$("#s_userYear").val("<?php echo $_userYear;?>");
	$("#s_userEmail").val("<?php echo $_userEmail;?>");
	$("#s_userEmailChk").val("<?php echo $_userEmailChk;?>");
	$("#s_index1").val("<?php echo $_s_index1;?>");
	$("#s_index2").val("<?php echo $_s_index2;?>");

	
	$("#no").val("<?php echo $_no;?>");
	if( pageList[1] == "page10.html" ){
		var str = "";
		for( var i=0; i < isoCode.length; i++  ){
			str += "<option value="+isoCode[i][1]+">"+isoCode[i][0]+"</option>";
		}
		$("#uContry").html(str);
		
	}

	if( pageList[1] == "page11.html" ){
		var str = "<option>Month</option>";
		for( var i=0; i < dMonth.length; i++  ){
			str += "<option value="+dMonth[i][1]+">"+dMonth[i][0]+"</option>";
		}
		$("#uMonth").html(str);

		str = "";
		for( var i=iDate.getFullYear(); i > 2000 ; i--  ){
			str += "<option value="+i+">"+i+"</option>";
		}
		$("#uYear").html(str);
	}

	
	
	if( pageList[1] == "page20.html" ){
		b_list( 'fom',fn_abc );
	}

	if( pageList[1] == "page13.html" ){
		$("#loginId").html($("#s_userPass").val());
	}
		
	if( pageList[1] == "page21.html" ){
		document.getElementById('move_video').addEventListener('ended', function(){
			playLoadCheck();
		});
	}

	if( pageList[1] == "page23.html" ){
		$("#fn").val("STORY"); //화면 이동시 no는 0으로 한다
		story_list( 'fom',fn_Story );
	}

	if( pageList[1] == "page24.html" ){
		$("#fn").val("STORY"); //화면 이동시 no는 0으로 한다
		$("#no").val(0); //화면 이동시 no는 0으로 한다
		story_list( 'fom',fn_Detail );
	}

	if( pageList[1] == "page25.html" ){
		$("#fn").val("VOC"); //화면 이동시 no는 0으로 한다
		$("#no").val( 0 );
		vo_ct = 0;
		story_list( 'fom',fn_VoclistData );
	}

	if( pageList[1] == "page26.html" ){
		$("#fn").val("VOC"); //화면 이동시 no는 0으로 한다
		$("#no").val( 0 );
		vo_ct = 0;
		story_list( 'fom',fn_VoclistData26 );

		$("#fn").val("VOCLIST"); 
		story_list( 'fom',fn_VoclistAnswer );
	}

	if( pageList[1] == "page30.html" ){
		$("#fn").val("VOC"); //화면 이동시 no는 0으로 한다
		$("#no").val( 0 );
		vo_ct = 0;
		story_list( 'fom',fn_VoclistData30 );
	}
	
	loginYn();

}); 


function viewHtml( var1 ){
	var iDate = new Date();
	$.ajax({
	    type : "GET", 
	    url : "pages/"+var1,
	    async : false,
	    dataType : "html",	
	    error : function(){
	        alert("메뉴 가져오기 실패"+var1);
	    },
	    success : function(Parse_data){
	    	$("#temp1").html(Parse_data);
	    	if( var1 == "menu.html" ){
	    		$("#container-menu").append( $("#temp1 .container").html() );
	    	}else{
	    		$("#container-page").append( 	$("#temp1 .container-body").html() );
	    	}

	    	$("#temp1").html("");
	    }
	     
	});

}



	
//abc 항목 리스트 불러오기
function fn_abc(data){
	var abcText = "";
	var storyText = "";
	var aliveText = "";
	var createText = "";
	var t1 = 0;
	var t2 = 0;
	var t3 = 0;
	var t4 = 0;

	
	for( var i=0; i < data.length; i++ ){

		if(data[i]["B_TITLE"].toUpperCase() == ("abc").toUpperCase()){
			if( t1 == 0 ){
				abcText += "<span class='selected'>"+data[i]["B_ADDRES"]+"</span>";
				t1++;
			}else{
				abcText += "<span>"+data[i]["B_ADDRES"]+"</span>";
			}
		}else if(data[i]["B_TITLE"].toUpperCase() == ("storybook").toUpperCase()){
			if( t2 == 0 ){
				storyText += "<span class='selected'>"+data[i]["B_ADDRES"]+"</span>";
				t2++;
			}else{
				storyText += "<span>"+data[i]["B_ADDRES"]+"</span>";
			}
			
		}else if(data[i]["B_TITLE"].toUpperCase() == ("alivebook").toUpperCase()){
			if( t3 == 0 ){
				aliveText += "<span class='selected'>"+data[i]["B_ADDRES"]+"</span>";
				t3++;
			}else{
				aliveText += "<span>"+data[i]["B_ADDRES"]+"</span>";
			}

			
		}else if(data[i]["B_TITLE"].toUpperCase() == ("creationstory").toUpperCase()){
			if( t4 == 0 ){
				createText += "<span class='selected'>"+data[i]["B_ADDRES"]+"</span>";
				t4++;
			}else{
				createText += "<span>"+data[i]["B_ADDRES"]+"</span>";
			}
			
		}

	}
	$("#abcPush").html( abcText );
	$("#storyPush").html( storyText );
	$("#alivePush").html( aliveText );
	$("#createPush").html( createText );

}


//패스워드 체크
function passCheck(var1){

	if( $("input:checkbox[id='priChk']").is(":checked") == false ){
		alert(" error : Privacy & Terms .. checked ");
		return false;
	}
	if( $("#userPass").val().length < 4 ){
		alert(" error :The password is more than four digits. ");
		return false;
	}

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
function email1( var1 ){

	$("#s_userEmail").val( $("#uEmail").val() );
	$("#s_userEmailChk").val( $("#uEmailChk").val() );

	login_insert('fom');

	goUrl(var1);
}


//로그인 찾기
function goLogin(){
	$("#s_type").val("select");
	$("#s_userNm").val($("#t_name").val());
	$("#s_userPass").val($("#t_pass").val());
	$("#s_userEmail").val($("#t_email").val());

	login('fom');
}


var move_img = "/content/01_abc/Alphabet_Images/";
var move_sound = "/content/01_abc/Alphabet_Image_TTS/";
var move_url = "/content/01_abc/Alphabet_Motion_300X300px_200419/";
//글자 클릭
function moveMp(var1,var2){
	
//리플레이 구분
	if( var2 == 1 ){
		playVal = var1;
	}
	$("#abcFont").html(playVal);
	playCnt=2;

	var move_src = "";
	var move_sound_url = "";
	for( var i = 0; i < moveArray.length; i++ ){
		if( moveArray[i][0] == playVal ){
			move_src = move_img+moveArray[i][1];
			move_sound_url = move_sound+moveArray[i][2];
			break;
		}
	}
	$("#move_img").attr("src",move_src);
//영상 변경
	$("#movie_src").attr("src", move_url+playVal+"_Motion.mp4");

	$("#audio").attr("src", move_sound_url);
	audioPlay();
	$("#move_video").load();
	$("#move_video").trigger("play");	
}


function playLoadCheck(){

	
	if( playCnt < 5 ){
		var ii = 1;
		for( var i = 0; i < moveArray.length; i++ ){
			if( moveArray[i][0] == playVal ){
				if( ii == playCnt ){
					$("#move_img").attr("src",move_img+moveArray[i][1]);
					$("#audio").attr("src",move_sound+moveArray[i][2]);
					$("#move_video").trigger("play");
					audioPlay();
					playCnt++;
					break;
				}else{
					ii++;
				}
			}
		}
	}else{
		playCnt=2;
	}
}


function audioPlay(){

	var aud = document.getElementById("audio");
	aud.play();

}

function fn_Story( data ){
	$("#viewList").html("");
	var str = "";
	for( var i=0; i < data.length; i++ ){
	
		str += '<div class="grid-item2" >';
		str += '<div class="divBox23">';
		str += "<div><img onclick=goToStoryUrl('"+data[i]["index1"]+"') src=/img/Storybook/"+data[i]["link"]+"/"+data[i]["i_index"]+".jpg width=284 height=158></div>";
		str += '</div>';
		str += '<div class="boxtitle textDefault bold">';
		str += ' Title';
		str += '</div>';
		str += '<div class="boxdescription2">';
		str += data[i]["story_text"];
		str += '</div>';
		str += ' </div>';
	}
	$("#viewList").html(str)
	
}

var stroyList = "";
function fn_Detail( data ){
	stroyList = data;
	fn_StoryDetail();
}

function fn_StoryDetail(){
	var index = $("#no").val();
	$("#viewList").html("");
	var str = "";

	if( index < 0  ){
		index = 0;
	}

	if( index > (stroyList.length-1) ){
		index = (stroyList.length-1);
	}

	$("#story_title").html(stroyList[index]["story_text"]);
	$("#story_img").attr("src","/img/Storybook/"+stroyList[index]["link"]+"/"+stroyList[index]["i_index"]+".jpg");
	$("#story_text").html(stroyList[index]["story_text"]+" Lesson "+stroyList[index]["lesson"]);
}


function goToStoryUrl(var1){
	$("#s_index").val(var1);
	goUrl("page24.html");
	
}

//다음버튼
function goLeftToClickStory(var1){
	$("#no").val( Number($("#no").val())-1 );
	fn_StoryDetail();
}

//이전버튼
function goRightToClickStory(var1){
	$("#no").val( Number($("#no").val())+1 );
	fn_StoryDetail();
}


var vo_ct = 0;  //클릭 인덱스
var vo_cnt = 3;
var vo_ccnt = 0;
var vocListData = "";
var vocListAns = "";
function fn_VoclistData(data){
	vocListData = data;
	fn_Voclist();
}

function fn_VoclistData26(data){
	vocListData = data;
	fn_Voclist();
}

//정답 리스트
function fn_VoclistAnswer(data){
	vocListAns = data;
	fn_Voclist1();
}

function fn_VoclistData30(data){
	vocListData = data;
	fn_Voclist30();
}

function fn_Voclist( ){
	$("#vocList").html("");
	var str ="";
	var index = $("#no").val();
	vo_ccnt = 0;

	if( index  < 0 ){
		index = 0;
	}
	else if(  (index*vo_cnt) >= vocListData.length ){
		index = index-1;	
	}
	
	for( var i = (index*vo_cnt); i < vocListData.length; i++ ){

		if( vo_ccnt < vo_cnt ){
        	str +="<div class='word'>"+vocListData[i]["v_list"]+"</div> ";
        	str +="<div class='wordmeaning'> ";
        	str += vocListData[i]["v_mng"];
        	str +=" </div> ";
        	vo_ccnt++;
    	}
	}

	$("#no").val(index);
	$("#vocList").html(str);
}

//다음버튼
function goLeftToClickVoc(){
	$("#no").val( Number($("#no").val())-1 );
	fn_Voclist();
}

//이전버튼
function goRightToClickVoc(){
	$("#no").val( Number($("#no").val())+1 );
	fn_Voclist();
}


//정답 보기
function fn_Voclist1( ){

	var index = $("#no").val();
	
 	var rList = vocListAns.slice();

 	if( index < 0  ){
		index = 0;
 	}
 	
 	if( index >= (vocListData.length-1) ){
		index = (vocListData.length-1);
 	}

 	$("#vocQue").html(vocListData[index]["v_mng"]);
 	
 	//정답 제거
	for(i=0; i < rList.length; i++ ){
		if( rList[i]["v_list"] == vocListData[index]["v_list"] ){
			rList.splice( i,(i+1) );
		}
	}
	//랜점 배열
	for(i=0; i < vocListAns.length; i++ ){
		var iint = Math.floor(Math.random() * rList.length);	
		if( (rList.length) > 3){
		 	 rList.splice( iint,1 );
		}
		
	}

	var str = "";
	var iint = Math.floor((Math.random() * rList.length));

	for( var i=0; i < rList.length; i++ ){

		if( iint == i ){
    		str += "<div class='selected'>";
    		str += vocListData[index]["v_list"];
    		str += "</div>"
		}
			str += "<div>";
    		str += rList[i]["v_list"];
    		str += "</div>"		
	}

	$("#vocQueAnsList").html( str );
	$("#no").val(index);

}

//다음버튼
function goLeftToClickVoc1(){
	$("#no").val( Number($("#no").val())-1 );
	fn_Voclist1();
}

//이전버튼
function goRightToClickVoc1(){
	$("#no").val( Number($("#no").val())+1 );
	fn_Voclist1();
}


//정답 보기
function fn_Voclist30( ){
	$("#vocWordList").html( "" );
	$("#vocWordList1").html( "" );
	var index = $("#no").val();
	
 	var rList = vocListAns.slice();

 	if( index < 0  ){
		index = 0;
 	}
 	
 	if( index >= (vocListData.length-1) ){
		index = (vocListData.length-1);
 	}

	$("#no").val(index);

	$("#vocWordText").html(vocListData[index]["v_sen"]);

	var arList = vocListData[index]["v_sen"].split(" ");

	for (i = arList.length; i; i -= 1) { 
		var j = Math.floor(Math.random() * i); 
		var x = arList[i - 1]; 
		arList[i - 1] = arList[j]; 
		arList[j] = x; 
	}
	
	var str1 = "";
	for( var i=0; i < arList.length; i++ ){
		str1 +="<div class='wordblack1 whitetext'><span class='f18'  onclick='vocAwsCheck(this)'>"+arList[i]+"</span></div>";
	}
	
	$("#vocWordList1").html( str1 );
}

var vocAwsCheckList = new Array();

var checkIndexId = 0;

function vocAwsCheck(var1){
	checkIndexId++;
	var obj = Object();
	obj.oId = "vc_"+checkIndexId;
	obj.oText = $(var1).html();
	vocAwsCheckList.push(obj);	
	vocAwsCheckView();
}

function vocAwsCheckDel(var1){


	for( var i=0; i < vocAwsCheckList.length; i++ ){
		if( vocAwsCheckList[i]["oId"] == var1){
			vocAwsCheckList.splice( i,1 );
		}	
		
	}
	
	
	vocAwsCheckView();
}

function vocAwsCheckView(var1){
	checkIndexId++;
	var obj = Object();

	var str = "";
	for( var i=0; i < vocAwsCheckList.length; i++ ){
		str +="<div class='wordblue1 whitetext'><span class='f18' onclick=vocAwsCheckDel('"+vocAwsCheckList[i]['oId']+"')>"+vocAwsCheckList[i]['oText']+"</span></div>";
	}
	$("#vocWordList").html( str );
}


</script>
</head>
<body>


<div id="temp1" style="display: none"> </div>  
   	<audio id="audio" src="/content/01_abc/Alphabet_Image_TTS/ant--_us_1.mp3">	</audio>
	
	<div class="body">
	  	<div class="container" id="container-menu"></div>
	    <div class="container" id="container-page"></div>
	  <!-- content end -->
	  
	</div>


</body>


</html>