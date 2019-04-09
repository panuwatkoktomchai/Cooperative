<?php
include "../../../connection/connectMysql.php";
if (array_key_exists('data',$_REQUEST)){
    foreach ($_REQUEST['data'] as $id => $amount) {
        $checkAmount = "SELECT * FROM cooperative.material_products where product_id = ".$id;
        $checkAmount = $conn->query($checkAmount);
        if ($checkAmount->num_rows == 0) {
            $_SESSION['setMaterial'] = true;
            $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
            $_SESSION['alert']['color'] = "orange";
            $_SESSION['alert']['message'] = "สินค้ารหัส ".$id." ยังไม่มีการตั้งค่าวัสดุในการผลิต";
            header('Location:../list.php');
            exit;
        }else{
            foreach ($checkAmount as $key => $value) {
                $compare = "select amount,title from materials where id = ".$value['material_id'];
                $compare = $conn->query($compare);
                $store = $compare->fetch_assoc();
                $text = "วัดดุที่ขาด ".$store['title']." จำนวนผลิตต่อหน่วย = ".$value['amount']." : วัสดุที่ใช้ ".$amount." x ".$value['amount']." = ".$value['amount'] * $amount." แต่วัสดุนี้มีอยู่ในสต๊อก = ".$store['amount'];
                echo $text. "<br>";
                if (($value['amount'] * $amount) > $store['amount']) {
                    $_SESSION['alertCompare'][$value['id']] = $text;
                }
            }
        }
    } // end loop check amount
    if (isset($_SESSION['alertCompare'])) {
        header('Location:../list.php');
        exit;
    } else {
        foreach ($_REQUEST['data'] as $id => $amount) {
            # code...
            $strGet = "select * from products where id = ".$id;
            $data = $conn->query($strGet);
            $data = $data->fetch_assoc();
            $_SESSION['orderProduce'][$data['id']] = $data;
            $_SESSION['orderProduce'][$data['id']]['add'] = $amount;
        }
        header("location:../form.php");
    }
    
}else {
    $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
    $_SESSION['alert']['color'] = "orange";
    $_SESSION['alert']['message'] = "กรุณาเลือกสินค้าก่อน";
    echo "<script> window.history.back(); </script>";
}
