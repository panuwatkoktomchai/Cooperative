<?php 
include "../../connection/connectMysql.php";
if(count($_SESSION['orderProduce']) == 0){
    $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
    $_SESSION['alert']['color'] = "orange";
    $_SESSION['alert']['message'] = "ยังไม่มีการเลือกรายการสั่งซื้อ";
    header('Location:form.php');
}elseif (!array_key_exists('orderProduce',$_SESSION)) {
    $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
    $_SESSION['alert']['color'] = "orange";
    $_SESSION['alert']['message'] = "ยังไม่มีการเลือกรายการสั่งซื้อ";
    header('Location:form.php');
}

$user = "select * from users ";
$distributor = $conn->query($user);

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
</head>
<body class="w3-padding" style="margin-top:50px">
    <form action="code/submitOrder.php" method="post">
        <div class="w3-border">
            <div class="w3-center">
                <h1 >ยืนยันการสั่งผลิต</h1>
            </div>
            <div class="w3-row w3-margin">
                <div class="w3-col m3 w3-border w3-padding">
                    <p>
                        <strong>รหัสสั่งผลิต</strong> รอการยืนยัน
                    </p>
                    <p>
                        <strong>วันที่สั่งผลิต </strong><?php echo date('d-m-Y') ?> <br>
                    </p>
                    <p>
                        <input required type="text" name="user_id" id="user" class="w3-input w3-border" placeholder="รหัสลูกค้า" autofocus>
                    </p>
                    <button type="button" onclick="document.getElementById('findUser').style.display='block'" class="w3-button w3-blue w3-round">ค้นหาลูกค้า</button>     
                    
                    <!-- modal -->
                    <div id="findUser" class="w3-modal w3-animate-opacity">
                        <div class="w3-modal-content">
                            <header class="w3-container w3-teal"> 
                                <h2>ค้นหาลูกค้า</h2>
                            </header>
                        <div class="w3-container w3-padding">
                            <input class="w3-input w3-border w3-padding" type="text" placeholder="ชื่อ" id="myInput" onkeyup="myFunction()">
                            <table class="w3-table-all w3-margin-top" id="myTable">
                                <tr>
                                    <th>รหัส</th>
                                    <th>ชื่อ</th>
                                    <th>...</th>
                                </tr>
                                <?php foreach ($customer as $key=>$value) {?>
                                    <tr>
                                        <td><?php echo $value['id'] ?></td>
                                        <td><?php echo $value['firstname'].' '.$value['lastname'] ?></td>
                                        <td>
                                            <button type="button" class="w3-button w3-green" onclick="setIdUser('<?php echo $value['id'] ?>')">เลือก</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                            <footer class="w3-container w3-blue-gray w3-padding">
                                <button type="button" onclick="document.getElementById('findUser').style.display='none'" class="w3-button w3-red">ยกเลิก</button>
                            </footer>
                        </div>
                    </div>
                    <!-- end modal -->  

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
                        foreach($_SESSION['orderProduce'] as $key=>$value){ 
                            $amount = $amount + $value['add']; 
                        ?>
                        <tr>
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['title'] ?></td>
                            <td><?php echo $value['price'] ?></td>
                            <td><?php echo $value['size'] ?></td>
                            <td><?php echo $value['amount'] ?></td>
                            <td class="w3-right"><i class="w3-text-green fa fa-plus" aria-hidden="true"> </i> <?php echo $value['add'] ?></td> 
                        </tr>
                        <?php } ?>
                        <tr>
                            <td class="w3-border" colspan="5">จำนวนสั่งรวม</td>
                            <td class="w3-right"><strong><?php echo $amount; ?></strong> หน่วย</td>
                        </tr>
                        <tr>
                            <td class="w3-border" colspan="5">จำนวนรายการสั่ง</td>
                            <td class="w3-right"><strong><?php echo count($_SESSION['orderProduce']); ?></strong> รายการ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br><br>
        </div>

        <div class="w3-padding">
            <button type="submit" class="w3-button w3-green"> ยืนยันการสั่งผลิต</button>
            <button type="button" onclick="window.history.back();" class="w3-button w3-orange"> ย้อนกลับ</button>
        </div>
    </form>
</body>
</html>

<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function setIdUser(value)
{
    $('#findUser').css('display','none');
    $('input[name=user_id]').val(value);
}
</script>