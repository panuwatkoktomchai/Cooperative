<?php
include "../../../../connection/connectMysql.php";
$strDelete = "delete from equiments where id = ".$_REQUEST['id'];
if ($conn->query($strDelete)) {
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "ลบข้อมูลเรียบร้อย";
    header('Location:/cooper/view/setting/materail_type/show.php');
} else {
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    if ($conn->errno == 1451) {
        $_SESSION['alert']['message'] = "ประเภทวัสดุนี้ถูกใช้งานอยู่ ไม่สามารถลบได้";
    }else {
        $_SESSION['alert']['message'] = $conn->error;
    }
    echo "<script> window.history.back(); </script>";
}