<?php 
include "../../../../connection/connectMysql.php";
$data = $_REQUEST['data'];

if ($_FILES['filUpload']['name']!='') {
    unlink('../'.$data['image']);
    $date = new DateTime();
    $date = $date->getTimestamp();
    $file_name = $_FILES['filUpload']['name'];
    $file_size =$_FILES['filUpload']['size'];
    $file_tmp =$_FILES['filUpload']['tmp_name'];
    $file_type=$_FILES['filUpload']['type'];  
    $image = "../fileUpload/".$date.$file_name; //ที่อยู่รูปภาพ
    move_uploaded_file($file_tmp,$image);
    $image = "fileUpload/".$date.$file_name;
    $sqlUpdate = "update employee set firstname = '".$data['firstname']."', lastname = '".$data['lastname']."', phone = '".$data['phone']."', address = '".$data['address']."', birthday = '".$data['birthday']."', image = '".$image."'";
}else {
    $sqlUpdate = "update employee set firstname = '".$data['firstname']."', lastname = '".$data['lastname']."', phone = '".$data['phone']."', address = '".$data['address']."', birthday = '".$data['birthday']."'";
}
$sqlUpdate = $sqlUpdate. " where id =".$_REQUEST['id'];
if ($conn->query($sqlUpdate)) {
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "บันทึกการเปลี่ยนแปลงแล้ว";
    header('Location:/cooper/view/setting/employee/show.php');
}else {
    echo "<script> window.history.back(); </script>";
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = $conn->error;
}