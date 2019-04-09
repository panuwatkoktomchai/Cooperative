<?php
include "../../../../connection/connectMysql.php";
$strDelete = "delete from material_products where id = ".$_GET['id'];
if ($conn->query($strDelete)) {
    $_SESSION['alert']['status'] = "เรียบร้อย";
    $_SESSION['alert']['color'] = "green";
    $_SESSION['alert']['message'] = "ลบข้อมูลเรียบร้อย";
    header('Location:../addMaterials.php?id='.$_GET['product']);
} else {
    $_SESSION['alert']['status'] = "ล้มเหลว";
    $_SESSION['alert']['color'] = "red";
    $_SESSION['alert']['message'] = $conn->error;
    echo "<script> window.history.back(); </script>";
}
