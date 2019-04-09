<?php 
include "../../connection/connectMysql.php";
if (!isset($_GET['id'])) {
    $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
    $_SESSION['alert']['color'] = "orange";
    $_SESSION['alert']['message'] = "ไม่สารถค้นหา หรือ ไม่มีการระบุรหัสรายการสั่งซื้อการเข้าหน้าปริ้นรายการสั่งซื้อ";
    echo "<script>history.go(-1);</script>";
    exit;
}
$company = "select * from companies limit 1";
$order_list = "select order_material_list.* , materials.title, materials.price from order_material left join order_material_list on order_material.id = order_material_list.order_material_id left join materials on order_material_list.material_id = materials.id where order_material.id = ".$_GET['id'];
$order = "select order_material.*, users.name from order_material left join users on order_material.user_id = users.id where order_material.id = ".$_GET['id'];
$order = $conn->query($order);
$company = $conn->query($company);
$order_list = $conn->query($order_list);
$company = $company->fetch_assoc();
$order = $order->fetch_assoc();
(float)$total = 0;
$price = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            font-size: 8pt;
        }
    </style>
</head>
<body class="w3-padding">
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
    <div id="printableArea" class="w3-card w3-padding w3-margin-top">
        <div class="w3-center">
            <img src="<?php echo $company['image'] ?>" alt="">
            <h2><?php echo $company['company'] ?></h2>
        </div>
        <div class="w3-center">
            ที่อยู่ : <?php echo $company['address'] ?> <br>
            เบอร์โทร : <?php echo $company['phone'] ?> <br>

        </div><br>
        <div style="text-align:center">
            <h3>ใบสั่งซื้อ</h3>
            รหัสสั่งซื้อ<span> <?php echo sprintf("%05d",$_GET['id']); ?></span>
        </div>
        <br>
        <div>
            <table width="100%">
                <thead>
                    <tr>
                        <th width="15%" style="text-align:left;">วันที่สั่งซื้่อ  <?php echo $order['created_at'] ?> </th>
                    </tr>
                    <tr>
                        <th style="text-align:left;">สั่งซื้อโดย <?php echo $order['name'];   ?></th>
                    </tr>
                    <tr>
                        <th>รหัสวัสดุ</th>
                        <th>ชื่วัสดุ</th>
                        <th>ราคา</th>
                        <th>จำนวนสั่งซื้อ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($order_list as $key=>$value){ 
                        $total = $total + (float)$value['amount'];
                        $price = $price + $value['price'] * $value['amount'];
                    ?>
                    <tr>
                        <td style="text-align:center"><?php echo sprintf("%05d",$value['material_id']) ?></td>
                        <td style="text-align:center"><?php echo $value['title'] ?></td>
                        <td style="text-align:center"><?php echo $value['price'] ?></td>
                        <td style="text-align:center"><?php echo $value['amount'] ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3">รวมจำนวนสั่งซื้อ</td>
                        <td style="text-align:right;"><b style="border-bottom: 3px double;"> <?php echo number_format($total,'2','.',',') ?> </b> </td>
                    </tr>
                    <tr>
                        <td colspan="3">ราคารวม</td>
                        <td style="text-align:right;"><b style="border-bottom: 3px double;"> <?php echo number_format($price,'2','.',',') ?> </b> </td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <p class="w3-center"> 
        <a class="w3-button w3-green" onclick="printDiv('printableArea')" >ปริ้น</a>  <a class="w3-button w3-red" onclick="window.history.go(-1)">ย้อนกลับ</a>
    </p>
</body>
</html>
<script>
    const myForm = document.getElementById('alert');
        myForm.style.display = 'block';
        setTimeout(() => {
            myForm.style.display = 'none';
    }, 8000);

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>