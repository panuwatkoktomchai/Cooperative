
<?php 
include "../../connection/connectMysql.php";
$sql = "select order_material.*, users.name from order_material join users on order_material.user_id = users.id order by created_at desc";
$data = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<title>Cooperative</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
a.disabled {
   pointer-events: none;
   cursor: default;
   color:#cccccc;
}
</style>
<body class="w3-light-grey">
<?php include "../../layout/header.php" ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<header class="w3-container" style="padding-top:22px">
        <h5 class="w3-left"><b><i class="fa fa-file-text-o"></i> รายงานการรับวัสดุ </b></h5>
    <!-- <a href="" class="w3-btn w3-blue-gray w3-margin-bottom w3-right w3-xlarge w3-round"><i class="fa fa-arrow-left" aria-hidden="true"> ย้อนกลับ</i></a> -->
</header>



<div class="w3-row-padding">
    <div class="w3-col m12">
        <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
                <table class="w3-table display" id="datableCustomer">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>รหัสสั่งซื้่อ</th>
                            <th>สั่งโดย</th>
                            <th>วันที่รับสินค้า</th>
                            <th>สถานะการสั่งซื้อ</th>
                            <th>รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $key=>$value) { ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['recive_date']; ?></td>
                                <td><span class="w3-tag w3-<?php echo $value['order_status']== 1 ? 'green' : 'orange' ?> w3-round"><?php echo $value['order_status'] == 0 ? "อยู่ระหว่างการสั่งซื้อ" : "รับวัสดุเรียบร้อย"; ?></span></td>
                                <td>
                                    <a class="w3-button w3-round <?php echo $value['order_status'] == 0 ? 'w3-blue': 'disabled'; ?>"  href="confirmRecive.php?id=<?php echo $value['id'] ?>">รับวัสดุ</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>             
            </div>
        </div>
    </div>
</div>

<?php include "../../layout/footer.php" ?>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#datableCustomer').DataTable();
} );
</script>