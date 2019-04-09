<?php

include "../../../../connection/connectMysql.php";
$created_at = date("Y-m-d h:i:s"); // วันที่บันทึก หรือ อัพเดท
$data = $_REQUEST['data'];
$sqlSave = "insert into materials (id, title, price, amount, equiment_id, created_at, updated_at) value(null, '".$data['title']."',".$data['price'].", ".$data['amount'].",".$data['material_type'].", '".$created_at."', '".$created_at."')";
if ($conn->query($sqlSave)) {
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