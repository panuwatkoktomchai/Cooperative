<?php
include "../../../connection/connectMysql.php";
if (array_key_exists('data',$_REQUEST)){
    foreach ($_REQUEST['data'] as $id => $amount) {
        # code...
        $strGet = "select * from products where id = ".$id;
        $data = $conn->query($strGet);
        $data = $data->fetch_assoc();
        $_SESSION['pos'][$data['id']] = $data;
        $_SESSION['pos'][$data['id']]['add'] = $amount;
    }
    header("location:../confirmOrder.php");
}else {
    $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
    $_SESSION['alert']['color'] = "orange";
    $_SESSION['alert']['message'] = "กรุณาเลือกสินค้าก่อน";
    echo "<script> window.history.back(); </script>";
}
