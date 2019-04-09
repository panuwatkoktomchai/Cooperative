<?php
// สำหรับเชื่อมต่อฐานข้อมูล
include "../../../connection/connectMysql.php";
unlink($_GET['file']);
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
    $image = $date.$file_name; //ที่อยู่รูปภาพ
    move_uploaded_file($file_tmp,"image/".$image);
    $sqlUpdate = "update users set name = '".$data['name']."',idcard = '".$data['idcard']."', address = '".$data['address']."', phone = '".$data['phone']."',
    image = '/cooper/view/profile/code/image/".$image."' where id = ".$_GET['id'];
    if ($conn->query($sqlUpdate)) {
        header('Location:/cooper/view/profile/edit.php');
        $_SESSION['alert']['status'] = "เรียบร้อย";
        $_SESSION['alert']['color'] = "green";
        $_SESSION['alert']['message'] = "บันทึกการเปลี่ยนแปลงแล้ว";

        $_SESSION['user']['name'] = $data['name'];
        $_SESSION['user']['phone'] = $data['phone'];
        $_SESSION['user']['email'] = $data['email'];
        $_SESSION['user']['image'] = "/cooper/view/profile/code/image/".$image;
    }else {
        echo "<script> window.history.back(); </script>";
        $_SESSION['alert']['status'] = "ล้มเหลว";
        $_SESSION['alert']['color'] = "red";
        $_SESSION['alert']['message'] = $conn->error;
    }
}else {
    $sqlUpdate = "update users set name = '".$data['name']."',idcard = '".$data['idcard']."', address = '".$data['address']."', phone = '".$data['phone']."' where id = ".$_GET['id'];
    if ($conn->query($sqlUpdate)) {
        header('Location:/cooper/view/profile/edit.php');
        $_SESSION['alert']['status'] = "เรียบร้อย";
        $_SESSION['alert']['color'] = "green";
        $_SESSION['alert']['message'] = "บันทึกการเปลี่ยนแปลงแล้ว";

        $_SESSION['user']['name'] = $data['name'];
        $_SESSION['user']['phone'] = $data['phone'];
        $_SESSION['user']['email'] = $data['email'];
    }else {
        echo "<script> window.history.back(); </script>";
        $_SESSION['alert']['status'] = "ล้มเหลว";
        $_SESSION['alert']['color'] = "red";
        $_SESSION['alert']['message'] = $conn->error;
    }
}
