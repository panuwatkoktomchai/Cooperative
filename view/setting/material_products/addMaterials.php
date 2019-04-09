
<!-- PHP -->
<?php
    include "../../../connection/connectMysql.php";
    if (isset($_GET['id'])) {
        # code...
        $strGet = "select * from products where id = ".$_GET['id'];
        $getList = "select material_products.*, materials.id as mid, materials.title as mtitle from material_products left join materials on material_products.material_id = materials.id where material_products.product_id = ".$_GET['id'];
        $getList = $conn->query($getList);
        $data = $conn->query($strGet);
        $data = $data->fetch_assoc();
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
<?php include "../../../layout/header.php" ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<header class="w3-container" style="padding-top:22px">
        <h5 class="w3-left"><b><i class="fa fa-user-circle"></i> วัสดุในการผลิต <?php echo $data['title'] ?></b></h5>
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
                        <input autofocus type="text" title="รหัสวัสดุต้องเป็นตัวเลขเท่านั้น" name="search" class="w3-input w3-border" placeholder="กรอกรหัสวัสดุ">
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
                        <strong>วัสดุ : </strong>
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
                    <strong>ประเภท : </strong>
                        &nbsp;&nbsp;<p id="type"></p>
                    </p>
                    </div>
                </div>
                <form action="code/addOrder.php?id=<?php echo $_GET['id'] ?>" method="post">
                    <p>
                        <input readonly  class="w3-input w3-border" type="text" name="id" style="width:20%;" placeholder="รหัสวัสดุ">
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
                            <th>รหัสวัสดุ</th>
                            <th>ชื่วัสดุ</th>
                            <th>จำนวนใช้ในการผลิต</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($getList as $key=>$value){ ?>
                        <tr>
                            <td><?php echo $value['mid'] ?></td>
                            <td><?php echo $value['mtitle'] ?></td>
                            <td><?php echo $value['amount'] ?></td>
                            <td>
                                <button onclick="document.getElementById('<?php echo $value['id'] ?>').style.display='block'" class="w3-button w3-orange w3-round">แก้ใขจำนวน</button>
                                <a href="code/deleteOrder.php?id=<?php echo $value['id'] ?>&product=<?php echo $_GET['id'] ?>" class="w3-button w3-red w3-round">ลบ</a>
                            </td>
                            <!-- modal -->
                            <div id="<?php echo $value['id'] ?>" class="w3-modal w3-animate-opacity">
                                <form action="code/editAmount.php?id=<?php echo $value['id'] ?>&product=<?php echo $_GET['id'] ?>" method="POST">
                                    <div class="w3-modal-content">
                                        <header class="w3-container w3-teal"> 
                                            <h2>แก้ใขจำนวนสั่งซื้อ</h2>
                                        </header>
                                    <div class="w3-container w3-padding">
                                        ระบุจำนวนสั่งซื้อ :
                                        <input required class="w3-input w3-border" placeholder="ระบุจำนวนใหม่" type="number" name="amount" value="<?php echo $value['amount'] ?>">
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
            <a href="show.php" class="w3-button w3-green w3-round">เรียบร้อย</a>
        </div>
    </div>
    </div>
</div>

<?php include "../../../layout/footer.php" ?>
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
            url: "code/findMaterial.php?id="+data,
            method: "get",
            success : function(res){
                console.log(res)
                
                if (res == "null") {
                    alert('ไม่มีวัสดุนี้ระบบ')
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
                    $('#type').text(obj['type'])
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