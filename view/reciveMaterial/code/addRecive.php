<?php
include "../../../connection/connectMysql.php";
$_SESSION['reciveMaterial'][$_POST['recive_id']]['id'] = $_POST['recive_id'];
$_SESSION['reciveMaterial'][$_POST['recive_id']]['title'] = $_POST['title'];
$_SESSION['reciveMaterial'][$_POST['recive_id']]['amount'] = $_POST['amount'];
$_SESSION['reciveMaterial'][$_POST['recive_id']]['price'] = $_POST['price'];

$_SESSION['alert']['status'] = "เรีบร้อย";
$_SESSION['alert']['color'] = "green";
$_SESSION['alert']['message'] = "เพิ่มรายการรับเรียบร้อยแล้ว";
// unset($_SESSION['reciveMaterial']);
header("location:../reciveMaterial.php?reciveId=".$_GET['id']);
