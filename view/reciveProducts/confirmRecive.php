<?php 
include "../../connection/connectMysql.php";
$user = "select * from users ";
$company = "select * from companies limit 1";
$produce = "select * from produce where id = ".$_GET['id'];
$list = "select products.*, produce_list.amount as amount_order from produce_list join products on produce_list.product_id = products.id where produce_list.produce_id = ".$_GET['id'];
$list = $conn->query($list);
$produce = $conn->query($produce);
$company = $conn->query($company);
$distributor = $conn->query($user);
$status = ['ระหว่างดำเนินการผลิต','ผลิตเสร็จแล้ว','ยังไม่จ่ายชำระเงิน','จ่ายชำาระแล้ว','ส่งสินค้าแล้ว','ยังไม่ส่งสินค้า'];

?>

<?php
    $strGet = "select * from customers ";
    $customer = $conn->query($strGet);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
</head>
<body  class="w3-padding" style="margin-top:50px">
    <div class="w3-border" id="content">
        <div class="w3-center">
            <?php
                $company = $company->fetch_assoc();
                $produce = $produce->fetch_assoc();
            ?>
            <br><br>
            <img src="<?php echo $company['image'] ?>" alt="" width="10%">
            <h1 ><?php echo $company['company'] ?></h1>
            <p><?php echo $company['address'] ?></p>
            <br>
            <h2>ใบสั่งผลิต</h2>
            <strong>สถานะ</strong> <?php echo $status[$produce['status']] ?>
        </div>
        <div class="w3-row w3-margin">
            <div class="w3-col m3 w3-border w3-padding">
                <p>
                    <strong>รหัสสั่งผลิต</strong> <?php echo $produce['id'] ?>
                </p>
                <p>
                    <strong>วันที่สั่งผลิต </strong><?php echo $produce['created_at'] ?> <br>
                </p>
                    <strong>รหัสลูกค้า </strong><?php echo $produce['customer_id'] ?> <br>
                <p>
                </p>
            </div>
        </div>
        <div class="w3-padding">
            <table class="w3-table-all w3-border">
                <thead>
                    <tr class="w3-gray">
                        <th>รหัสสินค้า</th>
                        <th>ชื่สินค้า</th>
                        <th>ราคา</th>
                        <th>ขนาด</th>
                        <th>จำนวนคงเหลือ</th>
                        <th>จำนวนสั่งผลิต</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $amount = 0;
                    $i =0;
                    foreach($list as $key=>$value){ 
                        $i = $i+1;
                        $amount = $amount + $value['amount_order']; 
                    ?>
                    <tr>
                        <td><?php echo $value['id'] ?></td>
                        <td><?php echo $value['title'] ?></td>
                        <td><?php echo $value['price'] ?></td>
                        <td><?php echo $value['size'] ?></td>
                        <td><?php echo $value['amount'] ?></td>
                        <td class=""><i class="w3-text-green fa fa-plus" aria-hidden="true"> </i> <?php echo $value['amount_order'] ?></td> 
                    </tr>
                    <?php } ?>
                    <tr>
                        <td class="w3-gray" colspan="5">จำนวนสั่งรวม</td>
                        <td class="w3-right"><strong><?php echo $amount; ?></strong> หน่วย</td>
                    </tr>
                    <tr>
                        <td class="w3-gray" colspan="5">จำนวนรายการสั่ง</td>
                        <td class="w3-right"><strong><?php echo $i; ?></strong> รายการ</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br><br>
    </div>

    <div class="w3-padding">
        <a href="code/confirmProduce.php?id=<?php echo $produce['id'] ?>&cusid=<?php echo $produce['customer_id'] ?>" class="w3-button w3-green"> บันทึกการผลิต</a>
        <a href="compansation.php?id=<?php echo $produce['id']?>&cusid=<?php echo $produce['customer_id'] ?>" class="w3-button w3-blue"> ดูผลตอบแทนลูกค้า</a>
        <button type="button" onclick="window.history.back();" class="w3-button w3-orange"> ย้อนกลับ</button>
    </div>
</body>
</html>
<script>
function printDocument() {
    var iframe = this._printIframe;
    if (!this._printIframe) {
        iframe = this._printIframe = document.createElement('iframe');
        document.body.appendChild(iframe);

        iframe.style.display = 'none';
        iframe.onload = function() {
        setTimeout(function() {
            iframe.focus();
            iframe.contentWindow.print();
        }, 1);
        };
    }

    iframe.src = 'printOrder.php?id=00001';
}
</script>