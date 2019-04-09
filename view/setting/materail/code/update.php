<?php 
include "../../../../connection/connectMysql.php";
$data = $_REQUEST['data'];
$sqlUpdate = "update materials set title = '".$data['title']."', price = ".$data['price'].", amount = ".$data['amount'].", equiment_id = '".$data['material_type']."'";
$sqlUpdate = $sqlUpdate. " where id =".$_GET['id'];
if ($conn->query($sqlUpdate)) {
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "บันทึกการเปลี่ยนแปลงแล้ว";
    header('Location:/cooper/view/setting/materail/show.php');
}else {
    echo "<script> window.history.back(); </script>";
    $_SESSION['alert']['status'] = "ล้มเหลว"; 
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = $conn->error;
}