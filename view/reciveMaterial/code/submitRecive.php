<?php
include "../../../connection/connectMysql.php";
$id = $_GET['id'];

$order = "select * from order_material_list where order_material_id = ".$id;
$order = $conn->query($order);

foreach ($order as $key => $value) {
    $updateAmount = "update materials set amount = amount + ".$value['amount']." where id = ".$value['id'];
    $conn->query($updateAmount);    
}
$updateOrder = "update order_material set order_status = 1 , recive_date = '".date('Y-m-d H:i:m')."' where id = ".$_GET['id'];
if ($conn->query($updateOrder)) {
    $_SESSION['alert']['status'] = "เรีบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "บันทีกการรับสินค้าเรียบร้อยแล้ว";
    header('Location:../recive.php');
}else{
    $_SESSION['alert']['status'] = "ล้มแหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = $conn->error;
    header('Location:../confirmRecive.php?id='.$id);
}