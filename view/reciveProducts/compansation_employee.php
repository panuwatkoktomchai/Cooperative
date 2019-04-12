
<!-- PHP -->
<?php
    include "../../connection/connectMysql.php";

    if ($_SESSION[$_GET['id']] == '') {
        $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
        $_SESSION['alert']['color'] = "orange";
        $_SESSION['alert']['message'] = "ยังมีมีการเพิ่มรายการรับสินค้า";
        header('location:recive.php?id='.$_GET['id']);
        exit;
    }

    if (isset($_GET['id'])) {
        # code...
        $list = "select products.*, produce_list.amount as amount_order,produce_list.recive from produce_list join products on produce_list.product_id = products.id where produce_list.produce_id = ".$_GET['id'];
        $getList = $conn->query($list);

        $sqlCompan = "select products.*, produce_list.amount as amount_order,produce_list.recive, compansation.price as compan_price from produce_list join products on produce_list.product_id = products.id left join compansation on products.id = compansation.product_id  where produce_list.produce_id = ".$_GET['id'];
        $compan = $conn->query($sqlCompan);
        error_reporting(0);
    } else {
        $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
        $_SESSION['alert']['color'] = "red";
        $_SESSION['alert']['message'] = "กรุณาเลือกสินค้าอีกครั้ง";
        header("location:form.php");
    }
    
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
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> ยืนยันข้อมูล <?php echo $data['title'] ?></b></h5>
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
            <hr>
            <div class="w3-panel w3-topbar w3-border-green w3-border">
            <h3><i class="w3-xlarge fa fa-info-circle"></i> รายละเอียดการรับสินค้า</h3>
                <table class="w3-table">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่สินค้า</th>
                            <th>จำนวนคงเหลือ</th>
                            <th>จำนวนสั่งผลิต</th>
                            <th>จำนวนรับทั้งหมด</th>
                            <th>จำนวนรับเพิ่ม</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($getList as $key=>$value){ 
                        ?>
                        <tr>
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['title'] ?></td>
                            <td><?php echo $value['amount'] ?></td>
                            <td><?php echo $value['amount_order'] ?></td> 
                            <td><?php echo $value['recive'] ?></td> 
                            <td><?php echo $_SESSION[$_GET['id']][$value['id']]['amount_recive'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <hr>
                <h3><i class="w3-xlarge fa fa-info-circle"></i> ผลตอบแทนพนักงาน</h3>
                <table class="w3-table">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่สินค้า</th>
                            <th>ราคาค่าตอบแทนต่อหน่วย</th>
                            <th>จำนวนรับเพิ่ม</th>
                            <th>รวม</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $check = true;
                        $total = 0;
                        foreach($compan as $key=>$value){ 
                            if ($value['compan_price'] == '') {
                                $check = false;
                            }
                            $total = $total+($value['compan_price'] * $_SESSION[$_GET['id']][$value['id']]['amount_recive']);
                        ?>
                        <tr>
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['title'] ?></td>
                            <td><?php echo ($value['compan_price']) ? $value['compan_price'] : "ยังไม่มีการตั้งค่าผลตอบแทน" ?></td> 
                            <td><?php echo $_SESSION[$_GET['id']][$value['id']]['amount_recive'] ?></td>
                            <td><?php echo ($value['compan_price']) ? $value['compan_price'] * $_SESSION[$_GET['id']][$value['id']]['amount_recive'] : "ยังไม่มีการตั้งค่าผลตอบแทน" ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td class="w3-gray" colspan="4">รวมผลตอบแทน</td>
                            <td class="price"><strong><?php echo $total ?></strong> บาท</td>
                        </tr>   
                    </tbody>
                </table>
                <br>
            </div>
            <?php if($check){ 
                $sql = "select * from employee";
                $employee = $conn->query($sql);    
            ?>
            <div class="w3-panel w3-topbar w3-border-green w3-border">
                <h3>เลือกพนักงาน</h3>
                    <label for="">ค้นหา</label>
                    <input id="myInput" class="w3-input w3-border" type="text" name="name_employee">
                <br>
                <form action="code/save.php?id=<?php echo $_GET['id'] ?>" method="post">
                <table class="w3-table" id="datableEmployee">
                    <thead>
                        <tr>
                            <th>รหัสพนักงาน</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>เบอร์</th>
                            <th>ที่อยู่</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($employee as $key=>$value){ 
                        ?>
                        <tr>
                            <td> <input required type="radio" class="w3-radio" name="employee" value="<?php echo $value['id'] ?>"> <?php echo $value['id'] ?></td>
                            <td><?php echo $value['firstname'] ?></td>
                            <td><?php echo $value['lastname'] ?></td> 
                            <td><?php echo $value['phone'] ?></td>
                            <td><?php echo $value['address'] ?></td>
                        </tr>
                    <?php } ?>
                    
                    </tbody>
                </table>
            </div>

            <button type="submit" class="w3-button w3-green w3-round">ทำรายการต่อไป</button>
            </form>
            <a href="recive.php?id=<?php echo $_GET['id'] ?>" class="w3-button w3-blue w3-round">ย้อนกลับ</a>
            <?php }else { ?>
                <p class="w3-text-red">สินค้าบางรายการยังไม่มีการกำหนดค่าตอบแทน</p>              
            <?php } ?>
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
    var table = $('#datableEmployee').DataTable({
        ordering:false,
    });

    $('#myInput').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );
} );
</script>

<script>
  const myForm = document.getElementById('alert');
  myForm.style.display = 'block';
  setTimeout(() => {
    myForm.style.display = 'none';
  }, 8000);
</script>