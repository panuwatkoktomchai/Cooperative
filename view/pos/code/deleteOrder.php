<?php 
session_start();
unset($_SESSION['pos'][$_GET['id']]);
$_SESSION['alert']['status'] = "เรียบร้อย";
$_SESSION['alert']['color'] = "green";
$_SESSION['alert']['message'] = "ยกเลือกรายการ ".$_GET['id']." เรียบร้อย";
header("location:../list.php");