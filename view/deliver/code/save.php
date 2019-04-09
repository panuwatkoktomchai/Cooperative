<?php
session_start();
// echo $_GET['id']."<br>";
// echo $_POST['description']."<br>";
$_SESSION['alert']['status'] = "เรียบร้อย";
$_SESSION['alert']['color'] = "green";
$_SESSION['alert']['message'] = "บันทึกข้อมูลจัดส่งแล้ว";
header('Location:../list.php');