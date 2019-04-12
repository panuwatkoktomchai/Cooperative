<?php 
include "../../../connection/connectMysql.php";
$strGet = "select products.*, produce_list.amount as amount_order from produce_list join products on produce_list.product_id = products.id where products.id = ".$_GET['pro_id']." and produce_list.produce_id = ".$_GET['order_id'];
if ($conn->query($strGet)) {
    $data = $conn->query($strGet);
    $data = json_encode($data->fetch_assoc(),true);
    if (empty($data)) {
        echo false;
    }
    echo $data;
} else {
    echo false;
}


