
<!-- PHP -->
<?php
    include "../../connection/connectMysql.php";
    error_reporting(0);
    session_start();
    if (!isset($_GET['reciveId'])) {
        header('Location:recive.php');
    }else {
        $data=[];
        $strGet = "select order_material.*,users.name, distributors.name as distributor from order_material join users on order_material.user_id = users.id join distributors on order_material.distributor_id = distributors.id where order_material.id = ".$_GET['reciveId']." and order_material.order_status = 0 limit 1;";
        $data = $conn->query($strGet);
        $data = $data->fetch_assoc();
        if (count($data)>=0) {
            $material = "select order_material_list.* ,materials.title, materials.id from order_material_list left join materials on order_material_list.material_id = materials.id where order_material_id = ".$data['id'];
            $material = $conn->query($material);
        }

        if (isset($_POST['findMaterial'])) {
            $sql = "select * from materials where id = ".$_POST['findMaterial']." limit 1";
            $find = $conn->query($sql);
            $find = $find->fetch_assoc();
        }
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
        <h5 class="w3-left"><b><i class="fa fa-ambulance"></i> รับวัสดุอุปกรณ์</b></h5>
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

            <form action="" method="post" id="search">
                <div class="w3-row w3-section">
                    <div class="w3-col" style="width:50px">
                        <i class="w3-xxlarge fa fa-search-plus"></i>
                    </div>
                    <div class="w3-rest">
                        <input autofocus type="text" pattern="[0-9]" title="รหัสรายการสั่งซื้อวัสดุต้องเป็นตัวเลขเท่านั้น" name="findMaterial" class="w3-input w3-border" placeholder="ระบุรหัสสั่งซื้อ">
                        <br>
                        <button type="submit" class="w3-button w3-light-blue w3-block">ค้นหา</button>
                    </div>
                </div>
            </form>
            <hr>

            <div class="w3-panel w3-topbar w3-border-green w3-border">
                <div class="w3-row">
                    <div class="w3-col m6">
                        <h3><i class="w3-xlarge fa fa-info-circle"></i> รายละเอียดการสั่งซื้อ</h3>
                        <?php if(isset($data)) { ?>
                        <p>
                            <span>รหัสสั่งซื้อ : <?php echo $data['id'] ?></span>
                        </p>
                        <p>
                            <span>สั่งซื้อโดย : <?php echo $data['name'] ?></span>
                        </p>
                        <p>
                            <span>วันที่สั่งซื้อ : <?php echo $data['created_at'] ?></span>
                        </p>
                        <p>
                            <span>ตัวแทนจำหน่าย : <?php echo $data['distributor'] ?></span>
                        </p>
                        <?php } ?>
                    </div>
                    <div class="w3-col m6">
                        <h3>รายละเอียดการค้นหา</h3>
                        <form action="code/addRecive.php?id=<?php echo $_GET['reciveId'] ?>" method="post">
                            <p>
                                <input required placeholder="รหัสวัสดุ" readonly type="text" class="w3-input w3-border" name="recive_id" value="<?php echo $find['id'] ?>">
                            </p>
                            <p>
                                <input required placeholder="ชื่อวัสดุ" readonly type="text" class="w3-input w3-border" name="title" value="<?php echo $find['title'] ?>">
                            </p>
                            <p>
                                <input required <?php echo isset($_POST['findMaterial']) ?  "autofocus" : "" ;  ?> placeholder="จำนวนรับ" type="number" class="w3-input w3-border" name="amount">
                            </p>
                            <p>
                                <input placeholder="ราคา" type="number" class="w3-input w3-border" name="price">
                            </p>
                            <?php if(isset($_POST['findMaterial'])) { ?>
                            <p>
                                <button try="submit" class="w3-button w3-green">รับ</button>
                            </p>
                            <?php } ?>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="w3-row">
                    <div class="w3-col m6 w3-padding">
                    <h4>ข้อมูลจากการสั่งซื้อ</h4>
                    <i class="fa fa-check-square w3-text-green" aria-hidden="true"></i>=จำนวนครบ | <i class="fa fa-plus w3-text-blue" aria-hidden="true"></i>=จำนวนเกิน | <i class="fa fa-minus w3-text-orange" aria-hidden="true"></i>=จำนวนไม่ครบ | <i class="fa fa-times-circle w3-text-red" aria-hidden="true"></i>=ยังไม่มีการรับ
                        <table class="w3-table w3-margin w3-striped w3-border">
                            <thead>
                                <tr>
                                    <th>รหัสวัสดุ</th>
                                    <th>ชื่วัสดุ</th>
                                    <th>จำนวนสั่งซื้อ</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($material)) { ?>
                                <?php foreach($material as $key=>$value){ ?>
                                <tr>
                                    <td><?php echo $value['id'] ?></td>
                                    <td><?php echo $value['title'] ?></td>
                                    <td><?php echo $value['amount'] ?></td>
                                    <td>
                                        <?php
                                            if ($_SESSION['reciveMaterial'][$value['id']]['amount'] == $value['amount']) {
                                                echo '<i class="fa fa-check-square w3-text-green" aria-hidden="true"></i>';
                                            }elseif ($_SESSION['reciveMaterial'][$value['id']]['amount'] > $value['amount']){
                                                echo '<i class="fa fa-plus w3-text-blue" aria-hidden="true"></i> '.($_SESSION['reciveMaterial'][$value['id']]['amount'] - $value['amount']); 
                                            }elseif($_SESSION['reciveMaterial'][$value['id']]['amount'] < $value['amount'] && isset($_SESSION['reciveMaterial'][$value['id']]['amount'])){
                                                echo '<i class="fa fa-minus w3-text-orange" aria-hidden="true"></i> '.($value['amount'] - $_SESSION['reciveMaterial'][$value['id']]['amount']); 
                                            } else{
                                                echo '<i class="fa fa-times-circle w3-text-red" aria-hidden="true"></i>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="w3-col m6 w3-padding">
                          <h4>ข้อมูลรับสินค้า</h4>      
                                รายการวัสดุ
                          <table class="w3-table w3-margin w3-striped w3-border">
                            <thead>
                                <tr>
                                    <th>รหัสวัสดุ</th>
                                    <th>ชื่วัสดุ</th>
                                    <th>จำนวนรับ</th>
                                    <th>ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(array_key_exists('reciveMaterial',$_SESSION)) { ?>
                                <?php foreach($_SESSION['reciveMaterial'] as $key=>$value){ ?>
                                <tr>
                                    <td><?php echo $value['id'] ?></td>
                                    <td><?php echo $value['title'] ?></td>
                                    <td><?php echo $value['amount'] ?></td>
                                    <td><?php echo $value['price'] ?></td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <button onclick="document.getElementById('reciveSubmit').style.display='block'" class="w3-button w3-green w3-round">ยืนยันการับวัสดุ</button>
            <button onclick="document.getElementById('reciveCancel').style.display='block'" class="w3-button w3-red w3-round">ยกเลิกรายการสั่งซื้อ</button>
            <!-- modal สำหรับยกเลิกรายการ -->
            <div id="reciveCancel" class="w3-modal w3-animate-opacity">
                <div class="w3-modal-content">
                    <header class="w3-container w3-teal"> 
                        <h2>ยืนยันการยกเลิก</h2>
                    </header>
                <div class="w3-container w3-padding">
                    <p>
                        คุณต้องการยกเลิกการรับวัสดุหรือไม่?
                    </p>
                </div>
                    <footer class="w3-container w3-blue-gray w3-padding">
                        <a href="code/cancelRecive.php?id=<?php echo $_GET['reciveId'] ?>" class="w3-button w3-orange">ตกลง</a>
                        <button type="button" onclick="document.getElementById('reciveCancel').style.display='none'" class="w3-button w3-gray">เก็บไว้ก่อน</button>
                    </footer>
                </div>
            </div>

            <!-- modal สำหรับยกเลิกรายการ -->
            <div id="reciveSubmit" class="w3-modal w3-animate-opacity">
                <div class="w3-modal-content">
                    <header class="w3-container w3-light-blue"> 
                        <h2>ยืนยันการรับสินค้า</h2>
                    </header>
                <div class="w3-container w3-padding">
                    <p>
                        คุณแน่ใจว่าตรวจสอบข้อมูลครบถ้วน และพร้อมที่จะบันทึกข้อมูลการรับ?
                    </p>
                </div>
                    <footer class="w3-container w3-padding">
                        <a href="code/submitRecive.php?id=<?php echo $_GET['reciveId'] ?>" class="w3-button w3-green">ตกลง</a>
                        <button type="button" onclick="document.getElementById('reciveSubmit').style.display='none'" class="w3-button w3-red">กลับ</button>
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