<?php
session_start();
$_SESSION['orderProduce'][$_GET['id']]['add'] = $_POST['amount'];
$_SESSION['alert']['status'] = "เรียบร้อย";
$_SESSION['alert']['color'] = "green";
$_SESSION['alert']['message'] = "แก้ใขจำนวนเรียบร้อยแล้ว";
header('Location:../form.php');