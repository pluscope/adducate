<?php

$db_conn = mysqli_connect("localhost", "root", "1", "adducate");


if(isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {
    $file = $_FILES['upfile'];
    $upload_directory = '/data/';
    $ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
    $allowed_extensions = explode(',', $ext_str);

    $max_file_size = 5242880;
    $ext = substr($file['name'], strrpos($file['name'], '.') + 1);

    

    // 확장자 체크
    if(!in_array($ext, $allowed_extensions)) {
        echo "업로드할 수 없는 확장자 입니다.";
    }

    

    // 파일 크기 체크
    if($file['size'] >= $max_file_size) {
        echo "5MB 까지만 업로드 가능합니다.";
    }

    

    $path = md5(microtime()) . '.' . $ext;
    if(move_uploaded_file($file['tmp_name'], $upload_directory.$path)) {
        $query = "INSERT INTO upload_file (file_id, name_orig, name_save, reg_time) VALUES(?,?,?,now())";
        $file_id = md5(uniqid(rand(), true));
        $name_orig = $file['name'];
        $name_save = $path;
        $stmt = mysqli_prepare($db_conn, $query);
        $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
        $exec = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        echo"<h3>파일 업로드 성공</h3>";
        echo '<a href="file_list.php">업로드 파일 목록</a>';
    }

} else {
    echo "<h3>파일이 업로드 되지 않았습니다.</h3>";
    echo '<a href="javascript:history.go(-1);">이전 페이지</a>';
}

mysqli_close($db_conn);

?>
