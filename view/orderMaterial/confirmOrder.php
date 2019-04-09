<?php 
include "../../connection/connectMysql.php";
if (!array_key_exists('orderMaterial',$_SESSION)) {
    header('Location:list.php');
}

$distributor = "select * from distributors ";
$distributor = $conn->query($distributor);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body class="w3-padding">
    <div class="w3-card w3-padding w3-margin-top">
        <h2>ยืนยันการสั่งซื้อวัสดุ : </h2>
        <p>
            <strong>วันที่สั่งซื้อ </strong> <?php echo date('Y-m-d'); ?>
        </p>
        <p>
            <strong>ผู้ทำรายการ </strong> <?php echo $_SESSION['user']['name'] ?>
        </p>
        <table class="w3-table w3-striped w3-border">
            <thead>
                <tr class="w3-gray">
                    <th>รหัสวัสดุ</th>
                    <th>ชื่วัสดุ</th>
                    <th>ราคา</th>
                    <th>ประเภท</th>
                    <th>จำนวนคงเหลือ</th>
                    <th>จำนวนสั่งซื้อ</th>
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
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <p>
            <form action="code/submitOrder.php" method="post">
                    เลือกตัวแทนจำหน่าย : 
                        <select class="w3-select" name="distributor" id="" style="width:20%;" required >
                            <option  disabled selected>เลือกตัวแทนจำหน่าย</option>
                            <?php foreach($distributor as $value) { ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    <br><br>
                    <button type="submit" class="w3-button w3-green">ยืนยัน</button>
                    <a class="w3-button w3-red" onclick="window.history.back();">ยกเลิก</a>
            </form>
        </p>
    </div>
</body>
</html>