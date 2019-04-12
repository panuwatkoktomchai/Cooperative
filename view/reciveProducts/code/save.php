<?php 

include "../../../connection/connectMysql.php";
if ($_GET['id'] == '' || $_POST['employee'] == '') {
    header('location:recive.php');
}


foreach ($_SESSION[$_GET['id']] as $key => $value) {
    //GET COMPANSATION
    $getCom = "select price from compansation where product_id = ".$key;
    $com = $conn->query($getCom);
    $com = $com->fetch_assoc();

    //INSERT HISTORY COMPANSATION EMPLOYE
    $sql = "INSERT INTO compansation_list SET ".
    "employee_id = ".$_POST['employee'].
    ", compansation = ".$com['price'] * $value['amount_recive'].
    ", produce_id = ".$_GET['id'].
    ", product_id =".$key.
    ", date = '".date('Y-m-d')."'";

   $conn->query($sql);

   $update = "UPDATE produce_list SET recive = recive + ".$value['amount_recive']." WHERE produce_id = ".$_GET['id']." and product_id = ".$key;
   $conn->query($update);
}

unset($_SESSION[$_GET['id']]);

//CHECK ORDER FINISHED
$checkFinishOrder = "SELECT * FROM produce_list WHERE produce_id = ".$_GET['id'];
$check = $conn->query($checkFinishOrder);
$finish = true;
foreach ($check as $key => $value) {
    if ($value['amount'] > $value['recive']) {
        $finish = false;
    }
}

if ($finish) {
    $updateFinish = "UPDATE produce SET status = 1 WHERE id = ".$_GET['id'];
    $conn->query($updateFinish);
    $txt = "จำนวนรับสินค้าครบแล้ว อัพเดทสถานะการสั่งผลิตเรียบร้อย";
}else {
    $txt = "[ยังไม่ปิดบิลการผลิตเนื่องจากจำนวนยังไม่ครบ]";
}

$_SESSION['alert']['status'] = "สำเร็จ";
$_SESSION['alert']['color'] = "green";
$_SESSION['alert']['message'] = "บันทึกค่าตอบแทนพนักงาน และรับสินค้าเรียบร้อย <br> ".$txt;
header('location:../recive.php?id='.$_GET['id']);