
<!-- PHP -->
<?php
    include "../../connection/connectMysql.php";
    $strGet = "select a.*, b.title as product_name from compansation_list a left join products b on a.product_id = b.id where a.employee_id = ".$_GET['emp_id'];
    $materials = $conn->query($strGet);

    $getWithdraw = "select withdraw.*, users.name as user_name from withdraw left join users on withdraw.user_id = users.id where withdraw.employee_id = ".$_GET['emp_id'];
    $withdraw = $conn->query($getWithdraw);

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
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> เบิกค่าตอบแทนพนักงาน</b></h5>
    <!-- <a href="" class="w3-btn w3-blue-gray w3-margin-bottom w3-right w3-xlarge w3-round"><i class="fa fa-arrow-left" aria-hidden="true"> ย้อนกลับ</i></a> -->
</header>

<div class="w3-card w3-round w3-white w3-padding">

<form action="code/save.php" method="post" class="w3-padding w3-border w3-round">
    <?php 
        $employee = "select id, concat(firstname,' ',lastname) as name from employee where id = ".$_GET['emp_id'];
        $sumMoney = "select sum(compansation) from compansation_list where employee_id = ".$_GET['emp_id'];
        $totalWithdraw = "select sum(price) from withdraw where employee_id =".$_GET['emp_id'];
        $sumMoney = $conn->query($sumMoney);
        $sumMoney = $sumMoney->fetch_assoc();
        $totalWithdraw = $conn->query($totalWithdraw);
        $totalWithdraw = $totalWithdraw->fetch_assoc();
        $employee = $conn->query($employee);
        $employee = $employee->fetch_assoc();
    ?>
    <label for="">ชื่อพนักงาน</label>
    <input readonly class="w3-input w3-border" type="text" name="" value="<?php echo $employee['name'] ?>">
    <input class="w3-input w3-border" type="hidden" name="emp_id" value="<?php echo $employee['id'] ?>">
    <label for="">ทำรายการโดย</label>
    <input readonly class="w3-input w3-border" type="text" name="" value="<?php echo $_SESSION['user']['name'] ?>">
    <input class="w3-input w3-border" type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>">
    <label for="">จำนวนเงินที่จะเบิก</label>
    <input autofocus required class="w3-input w3-border" type="number" name="price" id=" ">
    <br>
    <input type="submit" value="บันทึก" class="w3-button w3-green w3-round">
    <a href="list.php" class="w3-button w3-blue w3-round">ย้อนกลับ</a>
</form>

<div class="w3-row">
    <div class="w3-col s6 w3-center">
        <div class="w3-panel w3-topbar w3-border-green w3-border">
            <h3><i class="w3-xlarge fa fa-info-circle"></i> รายรับ</h3>
            <div class="w3-row w3-section">
                <table id="datableCustomer"  class="display w3-table">
                    <thead>
                    <tr class="w3-blue-gray">
                        <th> ชื่อสินค้าที่ผลิต </th>
                        <th> ผลตอบแทน </th>
                        <th>วันที่</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($materials as $key=>$value) {?>
                        <tr class="w3-center">
                            <td><?php echo $value['product_name'] ?></td>
                            <td><?php echo $value['compansation'] ?></td>
                            <td><?php echo $value['date'] ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="w3-col s6 w3-center">
        <div class="w3-panel w3-topbar w3-border-green w3-border">
            <h3><i class="w3-xlarge fa fa-info-circle"></i> ถอน</h3>
            <div class="w3-row w3-section">
                <table id="datableCustomer2"  class="display w3-table">
                    <thead>
                    <tr class="w3-blue-gray">
                        <th> จำนวนเงิน </th>
                        <th>เบิกโดย</th>
                        <th> สถานะ </th>
                        <th>วันที่</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($withdraw as $key=>$value) {
                        switch ($value['status']) {
                            case 0:
                                $txt = "รอการอนุมัติ";
                                $color = "orange";
                                break;
                            case 1:
                                $txt = "อนมัติแล้ว";
                                $color = "green";
                                break;
                            case 2:
                                $txt = "ถูกปฏิเสธ";
                                $color = "red";
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                        ?>
                        <tr class="w3-center">
                            <td><?php echo $value['price'] ?></td>
                            <td><?php echo $value['user_name'] ?></td>
                            <td><?php echo $txt ?></td>
                            <td><?php echo $value['date'] ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
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
    var table = $('#datableCustomer').DataTable({
    });

    var table2 = $('#datableCustomer2').DataTable({
    });

} );
</script>

