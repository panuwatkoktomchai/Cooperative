<?php

include "../../../connection/connectMysql.php";
$sql = "insert into withdraw set ".
    "employee_id = ".$_POST['emp_id'].
    ", user_id = ".$_POST['user_id'].
    ", price = ".$_POST['price'].
    ", status = 0".
    ", date = '".date('Y-m-d')."'";
if ($conn->query($sql)) {
    # code...
    $_SESSION['alert']['status'] = "สำเร็จ";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "บันทึกข้อมูลเรียบร้อย";
    header('location:../list.php');
}else {
    $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = $conn->error;
    header('location:../list.php');
}