<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/header_config_json.php");


$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
$data   = array();
$data['success'] = false;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_FILES['B_FILE']['name'];
    $size = $_FILES['B_FILE']['size'];
    
    
    if(strlen($name))
    {
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats))
        {
            if($size < ( 2024*1024 )) // Image size max 1 MB
            {
                $actual_image_name = time()."-image.".$ext;
                $tmp = $_FILES['B_FILE']['tmp_name'];

                if(move_uploaded_file($tmp, $path.$name))
                {
                    $data['success'] = true;
                    $data['fileName'] = $name;
                    $data['fileTemp'] = $name;
                }
                else
                {
                    $data['success'] = false;
                    $data['error'] = $path;
                }
                
            }
            else
                $data['error'] = "Image file size max 1 MB";
        }
        else
            $data['error'] = "Invalid file format..";
    }
    else
        $data['error'] = "Please select image..!";
}

echo json_encode($data);

?>
