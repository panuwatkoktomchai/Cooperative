<?php 
session_start();
unset($_SESSION['pos']);
$_SESSION['alert']['status'] = "เรียบร้อย";
$_SESSION['alert']['color'] = "green";
$_SESSION['alert']['message'] = "ยกเลิกรายการสั่งซื้อทั้งหมดแล้ว";
header('Location:../list.php');