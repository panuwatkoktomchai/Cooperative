
<!-- PHP -->
<?php
    include "../../connection/connectMysql.php";
    $strGet = "select * from materials";
    $data = $conn->query($strGet);
    error_reporting(0);
?>

<!-- HTML -->

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
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> สั่งซื้อวัสดุ</b></h5>
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

            <div class="w3-panel w3-topbar w3-border-green w3-border">
            <h3><i class="w3-xlarge fa fa-info-circle"></i> รายการที่เลือก</h3>
                <table class="w3-table">
                    <thead>
                        <tr>
                            <th>รหัสวัสดุ</th>
                            <th>ชื่วัสดุ</th>
                            <th>ราคา</th>
                            <th>ประเภท</th>
                            <th>จำนวนคงเหลือ</th>
                            <th>จำนวนสั่งซื้อ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($_SESSION['orderMaterial'] as $key=>$value){ ?>
                        <tr>
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['title'] ?></td>
                            <td><?php echo $value['price'] ?></td>
                            <td><?php echo $value['type'] ?></td>
                            <td><?php echo $value['amount'] ?></td>
                            <td><i class="w3-text-green fa fa-plus" aria-hidden="true"> </i> <?php echo $value['add'] ?></td>
                            <td>
                                <button onclick="document.getElementById('<?php echo $value['id'] ?>').style.display='block'" class="w3-button w3-orange w3-round">แก้ใขจำนวน</button>
                                <a href="code/deleteOrder.php?id=<?php echo $value['id'] ?>" class="w3-button w3-red w3-round">ลบ</a>
                            </td>
                            <!-- modal -->
                            <div id="<?php echo $value['id'] ?>" class="w3-modal w3-animate-opacity">
                                <form action="code/editAmount.php?id=<?php echo $value['id'] ?>" method="POST">
                                    <div class="w3-modal-content">
                                        <header class="w3-container w3-teal"> 
                                            <h2>แก้ใขจำนวนสั่งซื้อ</h2>
                                        </header>
                                    <div class="w3-container w3-padding">
                                        ระบุจำนวนสั่งซื้อ :
                                        <input required class="w3-input w3-border" placeholder="ระบุจำนวนใหม่" type="number" name="amount" value="<?php echo $value['add'] ?>">
                                    </div>
                                        <footer class="w3-container w3-blue-gray w3-padding">
                                            <button type="submit" class="w3-button w3-green">บันทึก</button>
                                            <button type="button" onclick="document.getElementById('<?php echo $value['id'] ?>').style.display='none'" class="w3-button w3-red">ยกเลิก</button>
                                        </footer>
                                    </div>
                                </form>
                            </div>
                            <!-- end modal -->
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <a href="confirmOrder.php" class="w3-button w3-green w3-round">ยืนยันการสั่งซื้อ</a>
            <button onclick="document.getElementById('orderCancel').style.display='block'" class="w3-button w3-red w3-round">ยกเลิกรายการสั่งซื้อ</button>
            <!-- modal สำหรับยกเลิกรายการ -->
            <div id="orderCancel" class="w3-modal w3-animate-opacity">
                <div class="w3-modal-content">
                    <header class="w3-container w3-teal"> 
                        <h2>ยืนยันการยกเลิก</h2>
                    </header>
                <div class="w3-container w3-padding">
                    <p>
                        คุณต้องการยกเลิกรายการสั่งซื้อวัสดุทั้งหมดหรือไม่?
                    </p>
                </div>
                    <footer class="w3-container w3-blue-gray w3-padding">
                        <a href="code/cancelOrder.php" class="w3-button w3-orange">ตกลง</a>
                        <button type="button" onclick="document.getElementById('orderCancel').style.display='none'" class="w3-button w3-gray">เก็บไว้ก่อน</button>
                    </footer>
                </div>
            </div>
            <!-- end modal -->
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