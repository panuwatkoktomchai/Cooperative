<?php 
include "../../../connection/connectMysql.php";

$strUpdateOrder = "update produce set status = 1";
try {

    $conn->query($strUpdateOrder);
    $getList = "select * from produce_list where produce_id = ".$_GET['id'];
    $getList = $conn->query($getList);
    $totalprice = 0;
    foreach ($getList as $key => $value) {
        $updateAmountproduct = "update products set amount = amount + ".$value['amount'];
        $conn->query($updateAmountproduct);
        $compansation = "select * from compansation where product_id = ".$value['product_id'];
        $compansation = $conn->query($compansation);
        $compansation = $compansation->fetch_assoc();
        $totalprice = $totalprice + ($compansation['price'] * $value['amount']);
    }
    // บันทึกผลตอบแทน
    // $addCompansation = "insert into compansation_list value (null, ".$_GET['cusid'].",".$totalprice.",".$_GET['id'].")";
    // $conn->query($addCompansation);
    header('Location:../form.php');
} catch (\Exception $th) {
    echo $th;
}