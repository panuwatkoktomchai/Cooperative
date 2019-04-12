<?php 
include "../../../connection/connectMysql.php";
$id = $_GET['id'];
$sqlGet = "select * from produce_list where product_id = ".$_POST['id']." and produce_id = ".$id;
$data = $conn->query($sqlGet);
$produce = $data->fetch_assoc();

if (($produce['recive'] + $_POST['amount']) > $produce['amount']) {
    $_SESSION['alert']['status'] = "เกิดข้อผิดพลาดบางอย่าง";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = "จำนวนเกินจากใบสั่งผลิต";
    header('Location:../recive.php?id='.$id);
    exit;
}else {
    # code...    
    $_SESSION[$_GET['id']][$_POST['id']]['amount_recive'] = $_POST['amount'];
    $_SESSION['alert']['status'] = "เรีบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "เพิ่มรายการรับเรียบร้อยแล้ว";
    header('Location:../recive.php?id='.$id);
}

