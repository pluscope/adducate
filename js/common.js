function loginYn(isLogin, userNm){
	if( isLogin != "" ){
		$("#signIn").hide();
		$("#logout").show();
		$("#logout").html("<a>"+userNm+"</a>");
		
	}
}

function menuLogin(){
	var userId = $("#userId").val() ;
	var userPass = $("#userPass").val();
	$.ajax({
		type : "POST",
		url : "/login.php",
		data : {userId: userId, userPass: userPass},
		dataType : "text",
		success : function(data){
			if(data==="y"){
				location.href = "/";
			}else{
				alert(data);
			}
		},
		error:function(request,status,error){
			alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}

	});
}