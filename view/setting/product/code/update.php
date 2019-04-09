<?php 
include "../../../../connection/connectMysql.php";
$data = $_POST['data'];
$sql = "update products set title = '".$data['title']."', description = '".$data['description']."', price = ".$data['price'].", amount = ".$data['amount'].", size = '".$data['size']."' where id = ".$_GET['id']; 
if ($conn->query($sql)) {
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "อัพเดทข้อมูลเรียบร้อย";
    header('Location:/cooper/view/setting/product/show.php');
}else {
    echo "<script> window.history.back(); </script>";
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = $conn->error;
}