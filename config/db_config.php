<?php
$conn = mysqli_connect("ec2-15-222-131-33.ca-central-1.compute.amazonaws.com", "root", "dureotkd410!@", "adducate_202009");
mysqli_query($conn, "set session character_set_connection=utf8;");
mysqli_query($conn, "set session character_set_results=utf8;");
mysqli_query($conn, "set session character_set_client=utf8;");
?>
