<?php
include "../../../../connection/connectMysql.php";
$strDelete = "delete from customers where id = ".$_REQUEST['id'];
if ($conn->query($strDelete)) {
    unlink('../'.$_REQUEST['file']);
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "ลบข้อมูลเรียบร้อย";
    header('Location:/cooper/view/setting/customer/show.php');
} else {
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = $conn->error;
    echo "<script> window.history.back(); </script>";
}
