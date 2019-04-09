<?php 
include "../../connection/connectMysql.php";
$produce = "select * from produce where id = ".$_GET['id'];
$list = "select products.*, produce_list.amount as amount_order from produce_list join products on produce_list.product_id = products.id where produce_list.produce_id = ".$_GET['id'];
$list = $conn->query($list);
$produce = $conn->query($produce);
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
                $produce = $produce->fetch_assoc();
                $customer = "select * from customers where id = ".$produce['customer_id'];
                $cus = $conn->query($customer);
                $cus = $cus->fetch_assoc();
            ?>
            <h2>บันทึกการส่งสินค้า</h2>
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
        <h3>ข้อมูลลูกค้า</h3>
            <table class="w3-table-all w3-border">
                <thead>
                    <tr class="w3-gray">
                        <th>รหัส</th>
                        <th>ชื่อ </th>
                        <th>นามสกุล</th>
                        <th>เบอร์</th>
                        <th>ที่อยู่</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $cus['id'] ?></td>
                        <td><?php echo $cus['firstname'] ?></td>
                        <td><?php echo $cus['lastname'] ?></td>
                        <td><?php echo $cus['phone'] ?></td>
                        <td><?php echo $cus['address'] ?></td>
                    </tr>
                </tbody>
            </table>

        <h3>ข้อมูลสินค้า</h3>
            <table class="w3-table-all w3-border">
                <thead>
                    <tr class="w3-gray">
                        <th>รหัสสินค้า</th>
                        <th>ชื่สินค้า</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>ขนาด</th>
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
                        <td class=""><i class="w3-text-green fa fa-plus" aria-hidden="true"> </i> <?php echo $value['amount_order'] ?></td> 
                    </tr>
                    <?php } ?>
                    <tr>
                        <td class="w3-gray" colspan="4">จำนวนสั่งรวม</td>
                        <td class="w3-right"><strong><?php echo $amount; ?></strong> หน่วย</td>
                    </tr>
                    <tr>
                        <td class="w3-gray" colspan="4">จำนวนรายการสั่ง</td>
                        <td class="w3-right"><strong><?php echo $i; ?></strong> รายการ</td>
                    </tr>
                </tbody>
            </table>
        <br><br>
        <form action="code/save.php?id=<?php echo $produce['id'] ?>" method="post">
            <label for="des">รายละเอียดการจัดส่ง</label>
            <textarea autofocus name="description" id="des" cols="30" rows="10" class="w3-input w3-border"></textarea>
        </div>
        
    </div>

    <div class="w3-padding">
        <button class="w3-button w3-green"> บันทึกการผลิต</button>
        <button type="button" onclick="window.history.back();" class="w3-button w3-orange"> ย้อนกลับ</button>
    </div></form>
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