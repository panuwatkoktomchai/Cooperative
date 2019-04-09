<?php
include "../../../../connection/connectMysql.php";
$created_at = date("Y-m-d h:i:s"); // วันที่บันทึก หรือ อัพเดท

$data = $_REQUEST['data'];
print_r($data);

if($_FILES["filUpload"]["name"] != '') // ครวจสอบว่ามีการระบุรูปจากฟอร์มหรือไม่ ถ้ามีก็บันทีกรูป
{
    $date = new DateTime();
    $date = $date->getTimestamp();
    $file_name = $_FILES['filUpload']['name'];
    $file_size =$_FILES['filUpload']['size'];
    $file_tmp =$_FILES['filUpload']['tmp_name'];
    $file_type=$_FILES['filUpload']['type'];  
    $image = "../fileUpload/".$date.$file_name; //ที่อยู่รูปภาพ
    move_uploaded_file($file_tmp,$image);
    $image = "fileUpload/".$date.$file_name;
}else {
    $image = "fileUpload/default.png";
}

$strInsert = "insert into customers (id, firstname, lastname, idcard, phone, address, image, birthday, gender, created_at, updated_at)".
            " value(null, '".$data['firstname']."', '".$data['lastname']."', '".$data['phone']."', '".$data['address']."', '".$image."', '".$data['birthday']."', '".$created_at."', '".$created_at."')";
if ($conn->query($strInsert)) {
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "บันทึกการเปลี่ยนแปลงแล้ว";
    header('Location:/cooper/view/setting/customer/show.php');
}else {
    echo $conn->error;
    // echo "<script> window.history.back(); </script>";
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = $conn->error;
}

