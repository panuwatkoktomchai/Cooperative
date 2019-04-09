<?php
include "../../../../connection/connectMysql.php";
$strDelete = "delete from products where id = ".$_GET['id'];
if ($conn->query($strDelete)) {
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "ลบข้อมูลเรียบร้อย";
    header('Location:/cooper/view/setting/product/show.php');
} else {
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    if ($conn->errno == 1451) {
        $_SESSION['alert']['message'] = "สินค้านี้ถูกใช้งานอยู่ ไม่สามารถลบได้";
    }else {
        $_SESSION['alert']['message'] = $conn->error;
    }
    echo "<script> window.history.back(); </script>";
}
