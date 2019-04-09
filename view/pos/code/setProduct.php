<?php
session_start();
$_SESSION['pos']['product'] = $_GET['id'];
$_SESSION['alert']['status'] = "เรียบร้อย";
$_SESSION['alert']['color'] = "green";
$_SESSION['alert']['message'] = "เลือกสินค้าที่จะผลิตเรียบร้อยแล้ว";
header('Location:../list.php');