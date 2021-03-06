
<?php 
include "../../connection/connectMysql.php";
$sql = "select produce.* , users.name as user_name, CONCAT(customers.firstname,' ',customers.lastname) as cus_name from produce join users on produce.user_id = users.id join customers on produce.customer_id = customers.id where produce.status in (1,2) order by created_at desc";
$data = $conn->query($sql);
$status = ['','ผลิตเสร็จแล้วรอจัดส่ง','ส่งสินค้าแล้ว'];
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
</style>
<body class="w3-light-grey">
<?php include "../../layout/header.php" ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<header class="w3-container" style="padding-top:22px">
        <h5 class="w3-left"><b><i class="fa fa-file-text-o"></i> บันทึกจัดส่งสินค้า </b></h5>
    <!-- <a href="" class="w3-btn w3-blue-gray w3-margin-bottom w3-right w3-xlarge w3-round"><i class="fa fa-arrow-left" aria-hidden="true"> ย้อนกลับ</i></a> -->
           
</header>
<div class="w3-row-padding">
    <div class="w3-col m12">
        <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">

            <!-- alert -->
            <?php if(isset($_SESSION['alert'])) { ?>
            <div id="alert" class="w3-panel w3-<?php echo $_SESSION['alert']['color'] ?> w3-animate-opacity w3-display-topright" style="index:100; margin-top:120px; width:500px;">
                <h3><?php echo $_SESSION['alert']['status'] ?>!</h3>
                <p><?php echo $_SESSION['alert']['message'] ?></p>
            </div> 
            <script>
                window.scrollTo(0, 0);
            </script>
            <?php 
                    unset($_SESSION['alert']);
                } 
            ?> 
            <!-- end alert -->
            
                <table class="w3-table display" id="datableCustomer">
                        <tr>
                            <th>#</th>
                            <th>รหัสผลิต</th>
                            <th>สมาชิก</th>
                            <th>ลูกค้า</th>
                            <th>วันที่</th>
                            <th>สถานะการผลิต</th>
                            <th>รายละเอียด</th>
                        </tr>
                        <?php foreach($data as $key=>$value) { ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['user_name']; ?></td>
                                <td><?php echo $value['cus_name']; ?></td>
                                <td><?php echo $value['created_at']; ?></td>
                                <td><span class="w3-tag w3-round w3-<?php echo $value['status'] < 2 ? 'orange' : 'green' ?>"><?php echo $status[$value['status']] ?></span></td>
                                <td> 
                                    <?php if($value['status'] ==1 ){ ?>
                                    <a class="w3-button w3-round w3-blue" href="deliver.php?id=<?php echo $value['id'] ?>">บันทึกการส่ง</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
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

<script>
  const myForm = document.getElementById('alert');
  myForm.style.display = 'block';
  setTimeout(() => {
    myForm.style.display = 'none';
  }, 8000);
</script>