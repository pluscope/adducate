<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config.php");
$M_SN = isset($_GET["M_SN"]) ? $_GET["M_SN"]:"";
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8"></meta>
<title>과정등록 </title>

<script>
    $(document).ready(function(){
        if($("#M_SN").val() != ""){
        	b_list('fom',callBak);
        }

     });
    
    function callBak( data ){
    
    	$("#B_TITLE").val( data[0]["B_TITLE"]  );  
    	$("#B_TEL").val( data[0]["B_TEL"] ); 
    	$("#B_HOME").val( data[0]["B_HOME"] ); 
    	$("#B_ADDRES").val( data[0]["B_ADDRES"] );  
    	$("#B_MUL_IMAGE").val( data[0]["B_MUL_IMAGE"] );
    	
    
    }

	function ehechValue(){
		if($("#M_SN").val() != "" ){
			b_wp_fn( 'U','fom' );
		}else{
			b_wp_fn( 'I','fom' );
		}
	}

	function listValue(){
		location.href="list.php";
	}
</script>
<body>
   
  <div style="float:left">
  	<form id="fom" name="fom" method="post" enctype="multipart/form-data">
  	<input type="hidden" name="B_MUL_IMAGE" id="B_MUL_IMAGE">
  	<input type="hidden" name="M_SN" id="M_SN" value="<?php echo $M_SN?>" />
 
  		<table border="1" >
			<tr>
				<td>그룹</td>
				<td>
					<SELECT id="B_TITLE" name="B_TITLE">
						<option value="abc">abc</option>
						<option value="storybook">storybook</option>
						<option value="alivebook">alivebook</option>
						<option value="creationstory">creationstory</option>
					</SELECT>
					
				</td>
			</tr>
		
			<tr>
				<td>항목</td>
				<td>
					<input type="text" id="B_ADDRES" name="B_ADDRES">
					
				</td>
			</tr>		
			<tr>
				<td>링크페이지</td>
				<td><input type="text" id="B_HOME" name="B_HOME"></td>
				
			</tr>
			
			<tr>
			<td>이미지</td>
			
			<td><input type="file" name="B_FILE" id="B_FILE"></td>
			</tr>
			<tr>
				<td colspan="2"> <input type="button" value="등록"  onClick="ehechValue()"> <input type="button" value="목록"  onClick="listValue()"> </td>
			</tr>
			
		</table>
	</form>
  </div>
</body>
</html>