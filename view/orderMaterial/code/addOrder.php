<?php
include "../../../connection/connectMysql.php";
if (!array_key_exists('data',$_REQUEST)) {
    $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
    $_SESSION['alert']['color'] = "orange";
    $_SESSION['alert']['message'] = "ยังไม่มีการเลือกข้อมูล";
    header('location:../list.php');
}else {
    foreach ($_REQUEST['data'] as $key => $value) {
        $strGet = "select materials.*, equiments.title as type from materials join equiments on materials.equiment_id = equiments.id where materials.id = ".$key;
        $data = $conn->query($strGet);
        $data = $data->fetch_assoc();
        $_SESSION['orderMaterial'][$data['id']] = $data;
        $_SESSION['orderMaterial'][$data['id']]['add'] = $value;
    }
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "เพิ่มรายการสั่งซื้อเรียบร้อยแล้ว";
    header("location:../form.php");
}