<?php 
session_start();
unset($_SESSION['reciveMaterial']);
$_SESSION['alert']['status'] = "เรีบร้อย";
$_SESSION['alert']['color'] = "green";
$_SESSION['alert']['message'] = "ยกเลิกรายการรับสินค้าแล้ว";
header("location:../reciveMaterial.php?reciveId=".$_GET['id']);