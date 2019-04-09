<?php
include "../../../connection/connectMysql.php";
$order_produce = "insert into produce value(null,".$_SESSION['user']['id'].",".$_POST['user_id'].",'".date('Y-m-d H:i:m')."',0);";
if ($conn->query($order_produce)) {
    $id = $conn->insert_id;
    $sql = "";
    foreach ($_SESSION['orderProduce'] as $key => $value) {
        $sql = "insert into produce_list value(null,".$id.",".$value['id'].",".$value['add'].")";
        $getMaterial = "select * from material_products where product_id = ".$value['id'];
        $getMaterial = $conn->query($getMaterial);

        $checkAmount = "SELECT * FROM cooperative.material_products where product_id = ".$value['id'];
        $checkAmount = $conn->query($checkAmount);
        if ($checkAmount->num_rows == 0) {
            $_SESSION['setMaterial'] = true;
            $_SESSION['setMaterial'] = true;
            $_SESSION['alert']['status'] = "เรียบร้อย";
            $_SESSION['alert']['color'] = "orange";
            $_SESSION['alert']['message'] = "สินค้ารหัส ".$id." ยังไม่มีการตั้งค่าวัสดุในการผลิต";
            header("location:../list.php");
            exit;
        }else{

            if (isset($_SESSION['alertCompare'])) {
                header('Location:../list.php');
                exit;
            } else { 

                //loop update amount materials;
                foreach ($getMaterial as $key => $valuecut) {
                    $updateAmount = "update materials set amount = amount - ".$valuecut['amount'] * $value['add']." where id = ".$valuecut['id'];
                    if (!$conn->query($updateAmount)) {
                        $_SESSION['alert']['status'] = "ล้มแหลว";
                        $_SESSION['alert']['color'] = "red";
                        $_SESSION['alert']['message'] = "บันทึกรายการสั่งซื้อล้มแหลว_ : ".$conn->error;
                        header('Location:../list.php');
                        exit();
                    }
                }// end loop check amount materails;

                // insert produce_list
                if ($conn->query($sql)==false) {
                    $_SESSION['alert']['status'] = "ล้มแหลว";
                    $_SESSION['alert']['color'] = "red";
                    $_SESSION['alert']['message'] = "บันทึกรายการสั่งซื้อล้มแหลว_ : ".$conn->error;
                    header('Location:../list.php');
                    exit();
                }
            } // end check amount
        } //end check materail = 0

    }// end loop session

    unset($_SESSION['orderProduce']);
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "บันทึกรายการสั่งซื้อเรียบร้อยแล้ว";
    header('Location:../list.php');

    
}else {
    $_SESSION['alert']['status'] = "ล้มแหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = "บันทึกรายการสั่งซื้อล้มแหลว : ".$conn->error;
    $conn->close();
    header('Location:../list.php');
}
