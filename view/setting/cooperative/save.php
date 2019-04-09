<?php
// สำหรับเชื่อมต่อฐานข้อมูล
include "../../../connection/connectMysql.php";

// นำค่าจากการกรอกข้อมูลไส่ใว้ในตัวแปร data
$data = $_REQUEST['data'];
// print_r($_REQUEST);
// exit;


$created_at = date("Y-m-d h:i:s"); // วันที่บันทึก หรือ อัพเดท

// บันทึกรูป
$image = "";
if($_FILES["filUpload"]["name"] != '') // ครวจสอบว่ามีการระบุรูปจากฟอร์มหรือไม่ ถ้ามีก็บันทีกรูป
{
    $date = new DateTime();
    $date = $date->getTimestamp();
    $file_name = $_FILES['filUpload']['name'];
    $file_size =$_FILES['filUpload']['size'];
    $file_tmp =$_FILES['filUpload']['tmp_name'];
    $file_type=$_FILES['filUpload']['type'];  
    $image = "fileUpload/".$date.$file_name; //ที่อยู่รูปภาพ
    move_uploaded_file($file_tmp,$image);
    $sqlUpdate = "update companies set company = '".$data['company']."', address = '".$data['address']."', phone = '".$data['phone']."',
    fax = '".$data['fax']."' ,image = '/cooper/view/setting/cooperative/".$image."'";
    if ($conn->query($sqlUpdate)) {
        $_SESSION['alert']['status'] = "เรียบร้อย";
        $_SESSION['alert']['color'] = "green";
        $_SESSION['alert']['message'] = "บันทึกการเปลี่ยนแปลงแล้ว";
        header('Location:/cooper/view/setting/setting.php');
    }else {
        echo "<script> window.history.back(); </script>";
        $_SESSION['alert']['status'] = "ล้มเหลว";
        $_SESSION['alert']['color'] = "red";
        $_SESSION['alert']['message'] = $conn->error;
    }
}else {
    $sqlUpdate = "update companies set company = '".$data['company']."', address = '".$data['address']."', phone = '".$data['phone']."',
    fax = '".$data['fax']."'";
    if ($conn->query($sqlUpdate)) {
        $_SESSION['alert']['status'] = "เรียบร้อย";
        $_SESSION['alert']['color'] = "green";
        $_SESSION['alert']['message'] = "บันทึกการเปลี่ยนแปลงแล้ว";
        header('Location:/cooper/view/setting/setting.php');
    }else {
        echo "<script> window.history.back(); </script>";
        $_SESSION['alert']['status'] = "ล้มเหลว";
        $_SESSION['alert']['color'] = "red";
        $_SESSION['alert']['message'] = $conn->error;
    }
}
