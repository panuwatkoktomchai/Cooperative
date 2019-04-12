
<!-- PHP -->
<?php
    include "../../connection/connectMysql.php";
    if (isset($_GET['id'])) {
        # code...
        $list = "select products.*, produce_list.amount as amount_order,produce_list.recive from produce_list join products on produce_list.product_id = products.id where produce_list.produce_id = ".$_GET['id'];
        $getList = $conn->query($list);
        error_reporting(0);
    } else {
        $_SESSION['alert']['status'] = "เกิดข้อผิดพลาด";
        $_SESSION['alert']['color'] = "red";
        $_SESSION['alert']['message'] = "กรุณาเลือกสินค้าอีกครั้ง";
        header("location:show.php");
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
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> รับสินค้า <?php echo $data['title'] ?></b></h5>
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
            <form action="" method="post" id="search">
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:50px">
                        <i class="w3-xxlarge fa fa-archive"></i>
                    </div>
                    <div class="w3-rest">
                        <input autofocus type="number" title="รหัสวัสดุต้องเป็นตัวเลขเท่านั้น" name="search" class="w3-input w3-border" placeholder="กรอกรหัสสินค้า">
                        <br>
                        <button type="submit" class="w3-button w3-light-blue w3-block">ค้นหา</button>
                    </div>
                </div>
            </form>
            
            <div class="w3-panel w3-topbar w3-border-green w3-border">
                <h3><i class="w3-xlarge fa fa-info-circle"></i> รายละเอียดการค้นหา</h3>
                <div class="w3-row">
                    <div class="w3-col m3">
                    <p>
                        <strong>สินค้า : </strong>
                        &nbsp;&nbsp;<p id="name"></p>
                    </p>
                    </div>
                    <div class="w3-col m3">
                    <p>
                        <strong>ราคา : </strong>
                        &nbsp;&nbsp;<p id="price"></p>
                    </p>
                    </div>
                    <div class="w3-col m3">
                    <p>
                    <strong>จำนวนคงเหลือ : </strong>
                        &nbsp;&nbsp;<p id="amount"></p>
                    </p>
                    </div>
                    <div class="w3-col m3">
                    <p>
                    <strong>ขนาด : </strong>
                        &nbsp;&nbsp;<p id="type"></p>
                    </p>
                    </div>
                </div>
                <form action="code/addRecive.php?id=<?php echo $_GET['id'] ?>" method="post">
                    <p>
                        <input readonly  class="w3-input w3-border" type="text" name="id" style="width:20%;" placeholder="รหัสสินค้า">
                    </p>
                    <p>
                        <input disabled="true" name="amount" type="number" name class="w3-input w3-border" required placeholder="ระบุจำนวน" style="width:20%;">
                    </p>
                    <button disabled class="w3-button w3-blue" type="submit" style="width:20%;">เพิ่มในวัสดุในการผลิต</button>
                </form>
                <br>

            </div>

            <div class="w3-panel w3-topbar w3-border-green w3-border">
            <h3><i class="w3-xlarge fa fa-info-circle"></i> รายการที่เลือก</h3>
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
                        $amount = 0;
                        $i =0;
                        foreach($getList as $key=>$value){ 
                            $i = $i+1;
                            $amount = $amount + $value['amount_order']; 
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
            </div>
            <a href="compansation_employee.php?id=<?php echo $_GET['id'] ?>" class="w3-button w3-green w3-round">ทำรายการต่อไป</a>
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

$('#search').submit(function(event){
    var data = $('input').val();
    if (data=='') {
        alert('กรุณาระบุรหัสวัสดุก่อน');
    }else{
        console.log("find data");
        $.ajax({
            url: "code/findMaterial.php?pro_id="+data+"&order_id=<?php echo $_GET['id'] ?>",
            method: "get",
            success : function(res){
                console.log(res)
                if (res == "null") {
                    alert('ไม่มีข้อมูลในรายการ')
                    $('#name').text('');
                    $('#price').text('');
                    $('#amount').text('');
                    $('#type').text('');
                    $('input[name=search]').val('');

                }else{
                    var obj = JSON.parse(res);
                    $('#name').text(obj['title'])
                    $('#price').text(obj['price'])
                    $('#amount').text(obj['amount'])
                    $('#type').text(obj['size'])
                    $('input[name=search]').val('')
                    $('input[name=amount]').prop('disabled', false);
                    $('input[name=amount]').focus();
                    $('input[name=id]').val(obj['id']);
                    $('button[type=submit]').prop('disabled',false);
                }
            }
        })
    }
    event.preventDefault();
})

</script>

<script>
  const myForm = document.getElementById('alert');
  myForm.style.display = 'block';
  setTimeout(() => {
    myForm.style.display = 'none';
  }, 8000);
</script>