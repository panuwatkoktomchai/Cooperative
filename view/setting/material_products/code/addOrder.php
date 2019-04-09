<?php
include "../../../../connection/connectMysql.php";
$check = "select * from material_products where product_id=".$_GET['id']." and material_id = ".$_POST['id'];
$check = $conn->query($check);
if ($check->num_rows > 0) {
    $_SESSION['alert']['status'] = "เกิดข้อผิดผลาด";
    $_SESSION['alert']['color'] = "orange";
    $_SESSION['alert']['message'] = "รายการนี้มีอยู่แล้ว";
    header("location:../addMaterials.php?id=".$_GET['id']);
} else {
    # code...
    $strGet = "insert into material_products value(null,".$_GET['id'].",".$_POST['id'].",".$_POST['amount'].")";
    if ($data = $conn->query($strGet)) {
        $_SESSION['alert']['status'] = "เรียบร้อย";
        $_SESSION['alert']['color'] = "green";
        $_SESSION['alert']['message'] = "เพิ่มรายการสั่งซื้อเรียบร้อยแล้ว";
        header("location:../addMaterials.php?id=".$_GET['id']);
    }else {
        $_SESSION['alert']['status'] = "ล้มแหลว";
        $_SESSION['alert']['color'] = "red";
        $_SESSION['alert']['message'] = $conn->error;
        header("location:../addMaterials.php?id=".$_GET['id']);
    }
}


