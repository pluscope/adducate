<?php
$conn = mysqli_connect("ec2-15-222-131-33.ca-central-1.compute.amazonaws.com", "root", "dureotkd410!@", "adducate");
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
mysqli_query($conn, "SET GLOBAL time_zone = '+9:00'");
function mysqli_result_to_array($result){
    $arrayofrows = array();
    $i = 0;
    foreach ($result as $row) {
        $arrayofrows[$i] = $row;
        ++$i;
    }
    return $arrayofrows;
}
?>
