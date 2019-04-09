<?php
session_start();
$_SESSION['orderProduce']['product'] = $_GET['id'];
$_SESSION['alert']['status'] = "เรียบร้อย";
$_SESSION['alert']['color'] = "green";
$_SESSION['alert']['message'] = "เลือกสินค้าที่จะผลิตเรียบร้อยแล้ว";
header('Location:../form.php');