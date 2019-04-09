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
    if ($conn->errno == 1062) {
        $_SESSION['alert']['message'] = "สินค้านี้ถูกตั้งค่าตอบแทนแล้ว";
    }else {
        $_SESSION['alert']['message'] = $conn->error;
    }
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    echo "<script> window.history.back(); </script>";
}