<?php
include_once( $_SERVER["DOCUMENT_ROOT"]."/header_config.php");

$_loginYn =  isset($_SESSION["M_NAME"])?$_SESSION["M_NAME"]:"";

?>

<title>Adducate Web App</title>
<link href="style.css" rel="stylesheet"> </link>
<link href="/stylesheets/menu.css" rel="stylesheet"></link>



<script>

var logSession = '<?= $_loginYn ?>';

$(document).ready( function() { 

	var pageList = ["menu.html","page1.html","page2.html","page3.html","page4.html"];
	
	for( var i=0; i < pageList.length; i++ ){
		viewHtml( pageList[i] );
	}
	loginYn();        
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
	    	$("#temp1").html(Parse_data); //div에 받아온 값을 넣는다.
	    	if( var1 == "menu.html" ){
	    		$("#container-menu").append( $("#temp1 .container").html() );
	    	}else{
	    		$("#container-page").append( 	$("#temp1 .container-body").html() ).trigger("create");
	    	}
	    	$("#temp1").html("");
	    }
	     
	});
}

</script>

</head>
<body>
<div id="temp1" style="display: none"> </div>
<div class="body">
  	
 	<div class="container" id="container-menu">
		
	
    </div>
    <div class="container" id="container-page">
		
	
    </div>
  <!-- content end -->
  
</div>

</body>


</html>