<?php 
include "../../../connection/connectMysql.php";
$strGet = "select * from products where id = ".$_GET['id'];
$data = $conn->query($strGet);
$data = json_encode($data->fetch_assoc(),true);
if (empty($data)) {
    echo false;
}
echo $data;