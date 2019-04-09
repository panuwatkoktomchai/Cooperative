<?php 
include "../../../../connection/connectMysql.php";
$strGet = "select materials.*, equiments.title as type from materials join equiments on materials.equiment_id = equiments.id where materials.id = ".$_GET['id'];
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


