
/**
 * 게시판 상세
 * var1 form 이름
 * */
function open_window( var1 ){
		window.open('/bbs/write_map.php',var1,"width=900,height=800,left=100,top=100,menubar=1");
}


/**
 * 회원가입
 * var1 form id
 * */
function login_insert(var1){
		var params =$("#"+var1).serializeArray();
		$.ajax({
		    type : "POST", 
		    url : "/action/action_login.php",
		    async : "true",
		    data : params,
		    dataType : "text",	
		    error : function(){
		        alert("통신실패!!!!");
		    },
		    success : function(data){
		    	alert(data);
		    }
		     
	});
}

/**
 * 로그인
 * var1 form id
 * */
function login(var1){
		var params =$("#"+var1).serializeArray();
		$.ajax({
		    type : "POST", 
		    url : "/action/action_login.php",
		    async : "true",
		    data : params,
		    dataType : "text",	
		    error : function(){
		        alert("통신실패!!!!");
		    },
		    success : function(data){
		    	if( data == 1 ){
		    		alert('로그인 되었습니다.');		
		    		location.href="/bbs/list.php";
		    	}else{
		    		alert('아이디가 및 패스워드가 틀렸습니다.');
		    	}
		    }
		     
	});
}


/**
 * 게시판 등록
 * var1 form 이름
 * */
function b_write( var1 ){
		var params =$("#"+var1).serializeArray();
		$.ajax({
		    type : "POST", 
		    url : "/action/action_write.php",
		    async : "true",
		    data : params,
		    dataType : "text",	
		    error : function(){
		        alert("통신실패!!!!");
		    },
		    success : function(data){
		    	alert("등록되었습니다.");
		    }
		     
	});
}


/**
 * 게시판 변경
 * var1 form 이름
 * */
function b_update( var1 ){
		var params =$("#"+var1).serialize();
		$.ajax({
		    type : "POST", 
		    url : "/action/action_update.php",
		    async : "true",
		    data : params,
		    dataType : "text",	
		    error : function(){
		    	alert( data );
		        alert("통신실패!!!!");
		    },
		    success : function(data){
		    	alert("등록되었습니다.");
		    }
		     
	});
}

/**
 * 게시판 상세
 * var1 form 이름
 * */
function b_detail( var1 ){
		var params =$("#"+var1).serialize();
		$.ajax({
		    type : "POST", 
		    url : "/action/action_detail.php",
		    data : params,	
		    dataType:"json",
	        success : function(data, status, xhr) {
	            console.log(data);
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	        	console.log(jqXHR.responseText);
	        }
		     
	});
}

/**
 * 게시판 리스트
 * var1 form 이름
 * var 2 callbak
 * */
function b_board_delete( var1 ){	
	
	if(confirm("삭제하시겠습니까?")){
		$.ajax({
		    type : "POST", 
		    url : "/action/action_delete.php",
		    data : {"B_SN":var1},	
		    dataType:"json",
	        success : function(data, status, xhr) {
	         //   var2(data);
	         alert("삭제되었습니다.");
	         location.href="/bbs/list.php"
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	          
	        	alert(jqXHR.responseText);
	        }
		     
		});
	}
}


/**
 * 게시판 리스트
 * var1 form 이름
 * var 2 callbak
 * */
function b_list( var1, var2 ){	
	var params =$("#"+var1).serialize();
		$.ajax({
		    type : "POST", 
		    url : "/action/action_list.php",
		    data : params,	
		    dataType:"json",
	        success : function(data, status, xhr) {
	            var2(data);
	         
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	          
	        	alert(jqXHR.responseText);
	        }
		     
	});
}


/**
 *  통계
 * var1 form 이름
 * var 2 callbak
 * */
function b_sum_list( var1,var2 ){	
	var params =$("#"+var1).serialize();
		$.ajax({
		    type : "POST", 
		    url : "/action/action_statistics.php",
		    data : params,	
		    async : "false",
		    dataType:"json",
	        success : function(data, status, xhr) {
	           
	           if( data.result.length == 0 ){
	        	   alert("조회된 내역이 없습니다.");
	           }
	        	var2(data.result);
	         
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	          
	        	alert(jqXHR.responseText);
	        }
		     
	});
}


/**
 * 비밀번호 변경
 * var1 form id
 * */
function b_updateInfo(var1){
		var params =$("#"+var1).serializeArray();
		if($("#M_PASS").val() == $("#M_PASS_1").val()){
			
		if(confirm("비밀번호를 변경하시겠습니까?")){}
			$.ajax({
			    type : "POST", 
			    url : "/action/action_updateInfo.php",
			    async : "true",
			    data : params,
			    dataType : "text",	
			    error : function(){
			        alert("통신실패!!!!");
			    },
			    success : function(data){
			    	alert('비밀번호가 변경 되었습니다.');
			    }
			     
			});
		}else{
			alert( "비밀번호가 틀렸습니다. 다시 확인 해주세요." );
		}
}


/**
 * 로그아웃
 * var1 form id
 * */
function logOut(var1){
		var params =$("#"+var1).serializeArray();
		$.ajax({
		    type : "POST", 
		    url : "/action/action_logOut.php",
		    async : "true",
		    data : params,
		    dataType : "text",	
		    error : function(){
		        alert("통신실패!!!!");
		    },
		    success : function(data){
		    	alert('로그아웃 되었습니다.');
		    }
		     
	});
}


/*  좌표 구학디 */
//distance(37.275517, 127.116578, 37.276556, 127.116243);
function distance(lat1, lon1, lat2, lon2) {
    var theta = lon1 - lon2;
    var dist = Math.sin(deg2rad(lat1)) * Math.sin(deg2rad(lat2)) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.cos(deg2rad(theta));

    dist = Math.acos(dist);
    dist = rad2deg(dist);
	dist = dist * 60 * 1.1515;
	dist = dist * 1609.344;
    return dist.toFixed(0)
}



function deg2rad(deg) {
    return (deg * Math.PI / 180.0);
}


function rad2deg(rad) {
    return (rad * 180 / Math.PI);
}
/* 좌표 구하기 종료 */
