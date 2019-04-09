<?php 
include "../../../../connection/connectMysql.php";
$data = $_POST['data'];
$sql = "insert into compansation (id, product_id, price ) value(null, ".$data['product_id'].", ".$data['price'].")";
if ($conn->query($sql)) {
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "บันทึกการเปลี่ยนแปลงแล้ว";
    header('Location:/cooper/view/setting/compansation/show.php');
}else {
    echo "<script> window.history.back(); </script>";
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = $conn->error;
}