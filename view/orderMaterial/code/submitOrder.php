<?php
include "../../../connection/connectMysql.php";
$order_material = "insert into order_material value(null,".$_SESSION['user']['id'].",'".date('Y-m-d H:i:m')."',0,null,".$_POST['distributor'].");";
if ($conn->query($order_material)) {
    $id = $conn->insert_id;
    $sql = "";
    foreach ($_SESSION['orderMaterial'] as $key => $value) {
        $sql = "insert into order_material_list value(null,".$id.",".$value['id'].",".$value['add'].")";
        if ($conn->query($sql)==false) {
            $_SESSION['alert']['status'] = "ล้มแหลว";
            $_SESSION['alert']['color'] = "red";
            $_SESSION['alert']['message'] = "บันทึกรายการสั่งซื้อล้มแหลว_ : ".$conn->error;
            header('Location:../form.php');
            exit();
        }
    }
    unset($_SESSION['orderMaterial']);
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "บันทึกรายการสั่งซื้อเรียบร้อยแล้ว";
    header('Location:../printOrder.php?id='.$id);

    
}else {
    $_SESSION['alert']['status'] = "ล้มแหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = "บันทึกรายการสั่งซื้อล้มแหลว : ".$conn->error;
    $conn->close();
    header('Location:../form.php');
}
