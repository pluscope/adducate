
<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_json.php");
header("Content-Type:application/json");
$fn = isset($_POST["fn"]) ? $_POST["fn"] : "STORY";
$B_TABLE = isset($_POST["s_index"]) ? $_POST["s_table"] : "B_BOARD";
$no = isset($_POST["no"]) ? $_POST["no"] : "";
$s_index1 = isset($_POST["s_index1"]) ? $_POST["s_index1"] : "0";
$s_index2 = isset($_POST["s_index2"]) ? $_POST["s_index2"] : "0";
// 1. 데이터베이스에서 데이터를 가져옴

if( $fn == "STORY" ){
    $sql = "select a.no,a.book index1, replace(b.c_nm,' ','') link, b.c_nm book,c.c_nm title,lesson,i_index,story_text ";
    $sql    .= " from storybook_img a  ";
    $sql    .= "   left outer join b_code b  ";
    $sql    .= "   on a.book = b.c_cd  ";
    $sql    .= "   and b.c_root = '0000'  ";
    $sql    .= "   left outer join b_code c  ";
    $sql    .= "   on a.book = c.c_root  ";
    $sql    .= "   and a.lesson = c.c_cd";
    $sql    .= "   where 1=1 ";
    
    if($s_index1 != "" && $s_index1 != "0"){
        $sql .= " and a.book = $s_index1 ";
    }
    
    
    $result = mysqli_query($conn,$sql);
    
    $list = array();
    while($row = mysqli_fetch_array($result)){
        array_push($list, array('no'=>$row[0],'index1'=>$row[1],'link'=>$row[2],'book'=>$row[3],'title'=>$row[4],'lesson'=>$row[5],'i_index'=>$row[6],'story_text'=>$row[7] ));
        
    }

}
else if( $fn == "VOC" ){
    $sql = "select a.no, a.book index1,replace(b.c_nm,' ','') link, b.c_nm book,c.c_nm title,lesson,i_index,voc_list v_list,voc_mng v_mng,voc_sen v_sen ";
    $sql    .= " from storybook_word a  ";
    $sql    .= "   left outer join b_code b  ";
    $sql    .= "   on a.book = b.c_cd  ";
    $sql    .= "   and b.c_root = '0000'  ";
    $sql    .= "   left outer join b_code c  ";
    $sql    .= "   on a.book = c.c_root  ";
    $sql    .= "   and a.lesson = c.c_cd";
    $sql    .= "   where 1=1 ";
    
    if($s_index1 != "" && $s_index1 != "0"){
        $sql .= " and a.book = $s_index1 ";
    }
    
   
    
    $result = mysqli_query($conn,$sql);
    $list = array();
    while($row = mysqli_fetch_array($result)){
        array_push($list, array('no'=>$row[0],'index1'=>$row[1],'link'=>$row[2],'book'=>$row[3],'title'=>$row[4],'lesson'=>$row[5],'i_index'=>$row[6],'v_list'=>$row[7],'v_mng'=>$row[8],'v_sen'=>$row[9] ));
    }
}

echo json_encode($list);

?>