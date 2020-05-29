
/**
 * 게시판 상세
 * var1 form 이름
 * */
function open_window( var1 ){
		window.open('/bbs/write_map.php',var1,"width=900,height=800,left=100,top=100,menubar=1");
}

function loginYn(){
	//$("#loginIn").css('display','none');
	if( logSession != "" ){
		$("#loginIn").hide();
		$("#loginOut").show();
		
		$("#loginOut").html("<a>"+logSession+"</a>");
		
	}
}


function menuLogin(){
	$("#s_type").val("select") ;
	$("#s_userNm").val($("#m_id").val()) ;
	$("#s_userPass").val( $("#m_pass").val() );
	login('fom');
}

/**
 * 회원가입
 * var1 form id
 * */
function login_insert(var1){
		$("#s_type").val("insert");
	
		var params =$("#"+var1).serializeArray();
		$.ajax({
		    type : "POST", 
		    url : "/action/action_login.php",
		    async : false,
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
		    async : true,
		    data : params,
		    dataType : "text",	
		    error : function(){
		        alert("통신실패!!!!");
		    },
		    success : function(data){
		    	if( data == "Y"){
		    		alert('로그인 되었습니다.');		
		    		location.href="/index.php";
		    	}else{
		    		console.log(data);
		    		alert('아이디 및 패스워드가 틀렸습니다.');
		    	}
		    }
		     
	});
}


function b_wp_fn(var0,var1){
	b_image_file(var0,var1);
}


function b_image_file( var0,var1 ){
	var imgName="";
	var datas, xhr;
	datas = new FormData();
 

    datas.append("B_FILE", $( '#B_FILE' )[0].files[0] );
    
    $.ajax({
        url: "/action/action_file.php", // url where upload the image
        contentType: 'multipart/form-data', 
        type: 'POST',
        data: datas,   
        async : false,
        dataType: 'json',     
        success: function (data) {     
        	imgName = data.fileTemp;

        	if( var0 == "I" ){
        		b_write( var1 ,imgName);
        	}else{
        		b_update( var1 ,imgName);
        	}
        	
             
        },
        error : function (jqXHR, textStatus, errorThrown) {
            alert('ERRORS: ' + textStatus);
        },
        cache: false,
        contentType: false,
        processData: false
    }); 
    
}

/**
 * 게시판 등록
 * var1 form 이름
 * */
function b_write( var1 ,var2){

		$("#B_MUL_IMAGE").val( var2 );	
	
		var params =$("#"+var1).serialize();
		
        $.ajax({
            url: "/action/action_write.php", // url where upload the image
            type: 'POST',
            data: params,   
            dataType: 'text',     
            success: function (data) {               
                 alert( "등록되었습니다."+data );                
            },
            error : function (jqXHR, textStatus, errorThrown) {
                alert('ERRORS: ' + textStatus);
            },
        });         
}


/**
 * 게시판 변경
 * var1 form 이름
 * */
function b_update( var1,var2 ){
		$("#B_MUL_IMAGE").val( var2 );	
		var params =$("#"+var1).serialize();

		$.ajax({
		    type : "POST", 
		    url : "/action/action_update.php",
		    async : "true",
		    data : params,
		    dataType : "text",	
		    error : function(){
		        alert("통신실패!!!!");
		    },
		    success : function(data){
		    	console.log( data );
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